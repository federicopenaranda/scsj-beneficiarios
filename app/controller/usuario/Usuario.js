Ext.define('sisscsj.controller.usuario.Usuario', {
    extend: 'sisscsj.controller.Base',
    boolUsuarioEdit: 0,
    stores: [
        'usuario.Usuario'
    ],
    views: [
        'usuario.Lista',
        'usuario.edit.Form',
        'usuario.edit.Window'
    ],
    refs: [
        {
            ref: 'UsuarioLista',
            selector: '[xtype=usuario.lista]'
        },
        {
            ref: 'UsuarioWindow',
            selector: '[xtype=usuario.edit.window]'
        },
        {
            ref: 'UsuarioForm',
            selector: '[xtype=usuario.edit.form]'
        },
        {
            ref: 'UsuarioPassword1Form',
            selector: '[xtype=usuario.edit.form] field#password1'
        },
        {
            ref: 'UsuarioPassword2Form',
            selector: '[xtype=usuario.edit.form] field#password2'
        },

        
        //////////////////////////////////////////////////////////////
        //  Referencias a Usuario Entidad y Beneficiario
        //////////////////////////////////////////////////////////////
        {
            ref: 'UsuarioEntidadLista',
            selector: '[xtype=usuario.listaentidad]'
        },
        {
            ref: 'UsuarioBeneficiarioLista',
            selector: '[xtype=usuario.beneficiariolista]'
        }
    ],
    init: function() {
        this.listen({
            controller: {},
            component: {
                'grid[xtype=usuario.lista]': {
                    beforerender: this.loadRecords,
                    itemdblclick: this.edit,
                    selectionchange: this.manejaBotones,
                    afterrender: this.manejaBotones
                },
                'grid[xtype=usuario.lista] button#add': {
                    click: this.add
                },
                'grid[xtype=usuario.lista] button#edit': {
                    click: this.edit
                },
                'grid[xtype=usuario.lista] button#delete': {
                    click: this.remove
                },
                'window[xtype=usuario.edit.window] button#save': {
                    click: this.save
                },
                'window[xtype=usuario.edit.window] button#cancel': {
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
        var grid = me.getUsuarioLista();
        var records = grid.getSelectionModel().getSelection();

        var botonEdit = grid.down("[xtype='toolbar'] button#edit");
        var botonDelete = grid.down("[xtype='toolbar'] button#delete");

        if (records.length > 0)
        {
            botonEdit.enable();
            botonDelete.enable();
        }
        else
        {
            botonEdit.disable();
            botonDelete.disable();
        }
    },


    loadRecords: function(grid, eOpts) {
        var me = this,
                store = grid.getStore();
        // clear any fliters that have been applied
        store.clearFilter(true);
        // load the store
        store.load();
    },


    edit: function(view, record, item, index, e, eOpts) {
        var me = this;
        
        me.boolUsuarioEdit = 1;

        var grid = me.getUsuarioLista();
        var record = grid.getSelectionModel().getSelection()[0];
        // show window
        me.showEditWindow(record);
    },


    add: function(button, e, eOpts) {
        var me = this,
                record = Ext.create('sisscsj.model.usuario.Usuario');
        
        me.boolUsuarioEdit = 0;

        // show window
        me.showEditWindow(record);
    },


    save: function(button, e, eOpts) {
        var me = this,
                grid = me.getUsuarioLista(),
                store = grid.getStore(),
                win = button.up('window'),
                form = win.down('form'),
                record = form.getRecord(),
                values = form.getValues(),
                callbacks;
        
        if ( me.boolUsuarioEdit === 1 )
        {
            var fieldUsuarioPassword1 = me.getUsuarioPassword1Form();
            var fieldUsuarioPassword2 = me.getUsuarioPassword2Form();
            fieldUsuarioPassword1.allowBlank = true;
            fieldUsuarioPassword2.allowBlank = true;
        }

        // Valida el formulario
        if ( form.isValid() )
        {
            // Creación registro nuevo con sus otros datos
            if ( me.boolUsuarioEdit === 0 && record.phantom )
            {
                values['usuario_entidad'] = me.saveUsuarioEntidad();
                values['usuario_beneficiario'] = me.saveUsuarioBeneficiario();
            }
            else
            {
                me.getController('usuario.UsuarioBeneficiario').sincronizar();
                me.getController('usuario.UsuarioEntidad').sincronizar();
            }

            /////////////////////////////////////////////////////////////////
            // [INICIO] Procesamiento de campo Lugares
            /////////////////////////////////////////////////////////////////
            var arrayLugares = []; // start with empty array
            var arrayLength = values['usuario_lugar'].length;
            for (var i = 0; i < arrayLength; i++) {
                if ( values['usuario_lugar'][i] > 0 )
                {
                    var tmpLugares = {
                        fk_id_lugar_actividad: values['usuario_lugar'][i]
                    };
                    arrayLugares.push(tmpLugares); // push this to the array
                }
            }
            var objLugares = Ext.encode(arrayLugares);
            values['usuario_lugar'] = objLugares;
            /////////////////////////////////////////////////////////////////
            // [FIN] Procesamiento de campo Lugares
            /////////////////////////////////////////////////////////////////

            // set values of record from form
            record.set(values);

            // check if form is even dirty...if not, just close window and stop everything...nothing to see here
            if (record.dirty) {
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
                Ext.getBody().mask('Guardando Usuario ...');
                // if new record...
                if (record.phantom) {
                    // reject any other changes
                    store.rejectChanges();
                    // add the new record
                    store.add(record);
                }
                // persist the record
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

        var grid = me.getUsuarioLista();
        var store = grid.getStore();
        var record = grid.getSelectionModel().getSelection()[0];
        
        // show confirmation before continuing
        Ext.Msg.confirm({
            title: 'Atención',
            msg: '¿Esta seguro que desea eliminar este Usuario?. Esta acción no puede ser deshecha.',
            icon: Ext.Msg.QUESTION,
            buttonText: {
                yes: 'Eliminar',
                no: 'Cancelar'
            },
            fn: function(buttonId, text, opt) 
            {
                if (buttonId == 'yes') {
                    store.remove(record);
                    store.sync({
                        failure: function(records, operation) {
                            store.rejectChanges();
                        }
                    })
                }
            }
        })
    },



    showEditWindow: function(record) {
        var me = this,
                win = me.getUsuarioWindow(),
                isNew = record.phantom;
        // if window exists, show it; otherwise, create new instance
        if (!win) {
            win = Ext.widget('usuario.edit.window', {
                title: isNew ? 'Añadir Usuario' : 'Editar Usuario'
            });
        }
        // show window
        win.show();
        // load form with data
        win.down('form').loadRecord(record);
        win.doComponentLayout();
    },


    saveUsuarioEntidad: function () {
        var me = this,
            grid = me.getUsuarioEntidadLista(),
            store = grid.getStore(),
            records = store.getModifiedRecords();

        // Guarda registros de estado de un usuario nuevo
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


    saveUsuarioBeneficiario: function () {
        var me = this,
            grid = me.getUsuarioBeneficiarioLista(),
            store = grid.getStore(),
            records = store.getModifiedRecords();

        // Guarda registros de estado de un usuario nuevo
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