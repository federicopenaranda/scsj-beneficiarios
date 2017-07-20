Ext.define('sisscsj.controller.entidad.Entidad', {
    extend: 'sisscsj.controller.Base',
    boolEntidadEdit: 0,
    stores: [
        'entidad.Entidad'
    ],
    views: [
        'entidad.Lista',
        'entidad.edit.Form',
        'entidad.edit.Window'
    ],
    refs: [
        {
            ref: 'EntidadLista',
            selector: '[xtype=entidad.lista]'
        },
        {
            ref: 'EntidadWindow',
            selector: '[xtype=entidad.edit.window]'
        },
        {
            ref: 'EntidadForm',
            selector: '[xtype=entidad.edit.form]'
        },
        {
            ref: 'EntidadInfoTab',
            selector: '[xtype=entidad.edit.tab.infoentidad]'
        },

        //////////////////////////////////////////////////////////////
        //  Referencias a Estados de Entidad
        //////////////////////////////////////////////////////////////
        {
            ref: 'EntidadEstadoEntidadLista',
            selector: '[xtype=entidad.listaentidadestadoentidad]'
        }
    ],
    init: function() {
        this.listen({
            controller: {},
            component: {
                'grid[xtype=entidad.lista]': {
                    beforerender: this.loadRecords,
                    itemdblclick: this.edit,
                    selectionchange: this.manejaBotones,
                    afterrender: this.manejaBotones
                },
                'grid[xtype=entidad.lista] button#add': {
                    click: this.add
                },
                'grid[xtype=entidad.lista] button#edit': {
                    click: this.edit
                },
                'grid[xtype=entidad.lista] button#delete': {
                    click: this.remove
                },
                'window[xtype=entidad.edit.window] button#save': {
                    click: this.save
                },
                'window[xtype=entidad.edit.window] button#cancel': {
                    click: this.close
                }
            },
            global: {},
            store: {},
            proxy: {}
        });
    },


    manejaBotones: function ( record, index, eOpts ){
        var me = this;
        var grid = me.getEntidadLista();
        var records = grid.getSelectionModel().getSelection();

        var botonEdit = grid.down("[xtype='toolbar'] button#edit");
        var botonDelete = grid.down("[xtype='toolbar'] button#delete");
        var botonMarcoLogico = grid.down("[xtype='toolbar'] button#marcologico");

        if (records.length > 0)
        {
            botonEdit.enable();
            botonDelete.enable();
            botonMarcoLogico.enable();
        }
        else
        {
            botonEdit.disable();
            botonDelete.disable();
            botonMarcoLogico.disable();
        }
    },


    loadRecords: function(grid, eOpts) {
        var store = grid.getStore();
        store.clearFilter(true);
        store.load();
    },


    edit: function(view, record, item, index, e, eOpts) {
        var me = this;
        
        me.boolEntidadEdit = 1;

        var grid = me.getEntidadLista();
        var record = grid.getSelectionModel().getSelection()[0];
        // show window
        me.showEditWindow(record);
    },


    add: function(button, e, eOpts) {
        var me = this,
                record = Ext.create('sisscsj.model.entidad.Entidad');
        
        me.boolEntidadEdit = 0;
        
        // show window
        me.showEditWindow(record);
    },


    save: function(button, e, eOpts) {
        var me = this,
                grid = me.getEntidadLista(),
                store = grid.getStore(),
                win = button.up('window'),
                form = win.down('form'),
                record = form.getRecord(),
                values = form.getValues(),
                callbacks;
        
        // Valida el formulario
        if ( form.isValid() )
        {
            var gridEstados = me.getEntidadEstadoEntidadLista(),
                    storeEstados = gridEstados.getStore(),
                    recStoreEstados = storeEstados.getCount();

            if ( recStoreEstados === 0 )
            {
                Ext.Msg.alert('Error de Validación', 'Una Entidad debe tener al menos un Estado.');
                return;
            }
            
            // Creación de entidad nueva con sus otros datos
            if ( me.boolEntidadEdit === 0 && record.phantom )
            {
                values['entidad_estado_entidad'] = me.saveEntidadEstado();
            }
            else
            {
                me.getController('entidad.EntidadEstado').sincronizar();
            }

            // set values of record from form
            record.set(values);

            if (record.dirty) {
                callbacks = {
                    success: function(records, operation) {
                        store.reload();
                        win.close();
                    },
                    failure: function(records, operation) {
                        store.rejectChanges();
                    }
                };

                Ext.getBody().mask('Guardando Entidad ...');

                if (record.phantom) {
                    store.rejectChanges();
                    store.add(record);
                }

                store.sync(callbacks);
                grid.getSelectionModel().clearSelections();
            }
        }
        else
        {
            Ext.Msg.alert('Error de Validación', 'Por favor revise los datos del formulario.');
            return;
        }
    },
            

    close: function(button, e, eOpts) {
        var me = this,
                win = button.up('window');
        // close the window
        win.close();
    },


    remove: function() {
        var me = this;

        var grid = me.getEntidadLista();
        var store = grid.getStore();
        var record = grid.getSelectionModel().getSelection()[0];
        
        // show confirmation before continuing
        Ext.Msg.confirm({
            title: 'Atención',
            msg: '¿Esta seguro que desea eliminar esta Entidad?. Esta acción no puede ser deshecha.',
            icon: Ext.Msg.QUESTION,
            fn: function(buttonId, text, opt) 
            {
                if (buttonId === 'yes') {
                    store.remove(record);
                    store.sync({
                        failure: function(records, operation) {
                            store.rejectChanges();
                        }
                    });
                }
            }
        });
    },



    showEditWindow: function(record) {
        var me = this,
                win = me.getEntidadWindow(),
                isNew = record.phantom;
        // if window exists, show it; otherwise, create new instance
        if (!win) {
            win = Ext.widget('entidad.edit.window', {
                title: isNew ? 'Añadir Entidad' : 'Editar Entidad'
            });
        }
        // show window
        win.show();
        // load form with data
        win.down('form').loadRecord(record);
        win.doComponentLayout();
    },
    
    
    saveEntidadEstado: function () {
        var me = this,
            grid = me.getEntidadEstadoLista(),
            store = grid.getStore(),
            records = store.getModifiedRecords();

        // Guarda registros de estado de una entidad nueva
        if (records.length > 0)
        {
            var array = []; // start with empty array

            for (var i = 0; i < records.length; i++) {
                var rec = records[i].getData();
                var tmp = rec;
                array.push(tmp); // push this to the array
            }

            var obj = Ext.encode(array);
            return obj;
        }
        else
        {
            return '';
        }
    },


    cancel: function(editor, context, eOpts) {
        // if the record is a phantom, remove from store and grid
        if (context.record.phantom) {
            context.store.remove(context.record);
        }
    }
});