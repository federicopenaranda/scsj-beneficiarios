Ext.define('sisscsj.controller.asistencia.Asistencia', {
    extend: 'sisscsj.controller.Base',
    boolAsistenciaEdit: 0,
    stores: [
        'asistencia.Asistencia',
        'asistencia.AsistenciaBeneficiario'
    ],
    views: [
        'asistencia.BeneficiariosLista',
        'asistencia.edit.AsistenciaForm',
        'asistencia.edit.Form',
        'asistencia.edit.Window',
        'asistencia.edit.tab.Asistencia',
        'asistencia.edit.tab.Beneficiarios'
    ],
    refs: [
        {
            ref: 'AsistenciaLista',
            selector: '[xtype=asistencia.lista]'
        },
        {
            ref: 'AsistenciaWindow',
            selector: '[xtype=asistencia.edit.window]'
        },
        {
            ref: 'AsistenciaForm',
            selector: '[xtype=asistencia.edit.form]'
        },
        {
            ref: 'AsistenciaTabForm',
            selector: '[xtype=asistencia.edit.asistenciaform]'
        },
        {
            ref: 'AsistenciaBeneficiariosLista',
            selector: '[xtype=asistencia.beneficiarioslista]'
        }
    ],
    init: function() {
        this.listen({
            controller: {},
            component: {
                'grid[xtype=asistencia.lista] button#add': {
                    click: this.add
                },
                'grid[xtype=asistencia.lista] button#edit': {
                    click: this.edit
                },
                'grid[xtype=asistencia.lista] button#delete': {
                    click: this.remove
                },
                'window[xtype=asistencia.edit.window] button#save': {
                    click: this.save
                },
                'window[xtype=asistencia.edit.window] button#cancel': {
                    click: this.close
                },
                'grid[xtype=asistencia.beneficiarioslista]': {
                    beforerender: this.loadRecords
                }
            },
            global: {},
            store: {},
            proxy: {}
        });
    },
    

    loadRecords: function(grid, eOpts) {
        var me = this,
                store = grid.getStore();
        // clear any fliters that have been applied
        store.clearFilter(true);
        // load the store
        store.load();
    },
    


    add: function(button, e, eOpts) {
        var me = this,
                record = Ext.create('sisscsj.model.asistencia.Asistencia');
        
        me.boolAsistenciaEdit = 0;
        
        // show window
        me.showEditWindow(record);
    },


    edit: function(view, record, item, index, e, eOpts) {
        var me = this,
                grid = me.getAsistenciaLista(),
                record = grid.getSelectionModel().getSelection()[0];
        
        me.boolAsistenciaEdit = 1;

        me.showEditWindow(record);
    },


    save: function(button, e, eOpts) {
        var me = this,
                grid = me.getAsistenciaLista(),
                store = grid.getStore(),
                win = button.up('window'),
                form = win.down('form'),
                record = form.getRecord(),
                values = form.getValues(),
                callbacks;

        if ( form.isValid() )
        {
            var gridBeneficiarios = me.getAsistenciaBeneficiariosLista(),
                    storeBeneficiarios = gridBeneficiarios.getStore(),
                    recStoreBeneficiarios = storeBeneficiarios.getCount();

            if ( recStoreBeneficiarios === 0 )
            {
                Ext.Msg.alert('Error de Validación', 'La asistencia debe tener al menos un Beneficiario.');
                return;
            }
            
            if ( me.boolAsistenciaEdit === 0 && record.phantom )
            {
                values['beneficiario_asistencia'] = me.saveTablaSecundaria( me.getAsistenciaBeneficiariosLista() );
            }
            else
            {
                me.getController('asistencia.AsistenciaBeneficiario').sincronizar();
            }
        }
        else
        {
            Ext.Msg.alert('Error de Validación', 'Por favor revise los datos del formulario.');
            return;
        }
        
        
        
        

        // set values of record from form
        record.set(values);
        
        // check if form is even dirty...if not, just close window and stop everything...nothing to see here
        if (!record.dirty) {
            win.close();
            return;
        }
        // setup generic callback config for create/save methods
        callbacks = {
            success: function(records, operation) {
                store.reload();
                win.close();
            },
            failure: function(records, operation) {
                // if failure, reject changes in store
                store.rejectChanges();
            }
        };
        // mask to prevent extra submits
        Ext.getBody().mask('Guardando Asistencia ...');
        // if new record...
        if (record.phantom) {
            // reject any other changes
            store.rejectChanges();
            // add the new record
            store.add(record);
        }
        // persist the record
        store.sync(callbacks);
    },


    remove: function() {
        var me = this;

        var grid = me.getAsistenciaLista(),
                store = grid.getStore(),
                record = grid.getSelectionModel().getSelection()[0];
        
        // show confirmation before continuing
        Ext.Msg.confirm('Atención', '¿Esta seguro que desea eliminar esta Asistencia?. Esta acción no puede ser deshecha.', function(buttonId, text, opt) {
            if (buttonId === 'yes') {
                store.remove(record);
                store.sync({
                    failure: function(records, operation) {
                        store.rejectChanges();
                    }
                });
            }
        });
    },
            

    close: function(button, e, eOpts) {
        var me = this,
                win = button.up('window');
        // close the window
        win.close();
    },


    showEditWindow: function(record) {
        var me = this,
                win = me.getAsistenciaWindow(),
                isNew = record.phantom;
        // if window exists, show it; otherwise, create new instance
        if (!win) {
            win = Ext.widget('asistencia.edit.window', {
                title: isNew ? 'Crear Asistencia' : 'Editar Asistencia'
            });
        }
        // show window
        win.show();
        // load form with data
        win.down('form').loadRecord(record);
        win.doComponentLayout();
    },


    cancel: function(editor, context, eOpts) {
        // if the record is a phantom, remove from store and grid
        if (context.record.phantom) {
            context.store.remove(context.record);
        }
    },


    saveTablaSecundaria: function ( grid ) {
        var store = grid.getStore(),
            records = store.getModifiedRecords();

        if (records.length > 0)
        {
            var array = [];

            for (var i = 0; i < records.length; i++) {
                var rec = records[i].getData();
                var tmp = rec;
                array.push(tmp);
            }

            var obj = Ext.encode(array);
            return obj;
        }
        else
        {
            return '';
        }
    }


});