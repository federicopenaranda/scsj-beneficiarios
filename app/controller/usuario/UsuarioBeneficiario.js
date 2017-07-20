Ext.define('sisscsj.controller.usuario.UsuarioBeneficiario', {
    extend: 'sisscsj.controller.Base',
    stores: [
        'usuario.UsuarioBeneficiario'
    ],
    views: [
        'usuario.BeneficiarioLista',
        'usuario.edit.FormBeneficiario',
        'usuario.edit.WindowBeneficiario'
    ],
    refs: [
        {
            ref: 'UsuarioBeneficiarioLista',
            selector: '[xtype=usuario.beneficiariolista]'
        },
        {
            ref: 'UsuarioBeneficiarioWindow',
            selector: '[xtype=usuario.edit.windowbeneficiario]'
        },
        {
            ref: 'UsuarioBeneficiarioForm',
            selector: '[xtype=usuario.edit.formbeneficiario]'
        },
        {
            ref: 'UsuarioLista',
            selector: '[xtype=usuario.lista]'
        }
    ],
    init: function() {
        this.listen({
            controller: {},
            component: {
                'grid[xtype=usuario.beneficiariolista]': {
                    beforerender: this.loadRecords,
                    itemdblclick: this.edit,
                    selectionchange: this.manejaBotones,
                    afterrender: this.manejaBotones
                },
                'grid[xtype=usuario.beneficiariolista] button#add': {
                    click: this.add
                },
                'grid[xtype=usuario.beneficiariolista] button#edit': {
                    click: this.edit
                },
                'grid[xtype=usuario.beneficiariolista] button#delete': {
                    click: this.remove
                },
                'window[xtype=usuario.edit.windowbeneficiario] button#save': {
                    click: this.save
                },
                'window[xtype=usuario.edit.windowbeneficiario] button#cancel': {
                    click: this.close
                }
            },
            global: {},
            store: {},
            proxy: {}
        });
    },


    loadRecords: function(grid, eOpts) {
        var me = this;
        var store = grid.getStore();

        // clear any fliters that have been applied
        store.clearFilter(true);
        var contRaiz = me.getController('usuario.Usuario');
        
        // Si se esta editando un usuario, filtrar el beneficiario por su ID
        if ( contRaiz.boolUsuarioEdit === 1)
        {
            var grid2 = me.getUsuarioLista();
            var dd = grid2.getSelectionModel().getSelection();

            if ( dd.length === 1 )
            {
                var record = dd[0];
                var data = record.getData();

                store.filter( 'fk_id_usuario', data['id_usuario'] );
            }
        }
    },


    manejaBotones: function ( record, index, eOpts ){
        var me = this;
        var grid = me.getUsuarioBeneficiarioLista();
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


    cancel: function(editor, context, eOpts) {
        // if the record is a phantom, remove from store and grid
        if (context.record.phantom) {
            context.store.remove(context.record);
        }
    },


    edit: function(records, index, node, eOpts) {
        var me = this;

        var grid = me.getUsuarioBeneficiarioLista();
        var record = grid.getSelectionModel().getSelection()[0];
        // show window
        me.showEditWindow(record);
    },


    add: function(button, e, eOpts) {
        var me = this,
            record = Ext.create('sisscsj.model.usuario.UsuarioBeneficiario');
        
        // [INICIO] Se recupera el ID del usuario para asociarlo al registro de beneficiario
        var grid1 = me.getUsuarioLista();
        var recSeleccionados = grid1.getSelectionModel().getSelection();
        var contRaiz = me.getController('usuario.Usuario');

        // Beneficiario ya creado
        if ( recSeleccionados.length === 1 && contRaiz.boolUsuarioEdit === 1 )
        {
            var record1 = recSeleccionados[0];
            var data1 = record1.getData();

            record.set('fk_id_usuario', data1['id_usuario']);

            me.showEditWindow(record);
        }
        else
        {
            // Beneficiario nuevo
            if ( contRaiz.boolUsuarioEdit === 0 )
            {
                me.showEditWindow(record);
            }
            else
            {
                console.log('[UsuarioBeneficiario] Error al recuperar el ID del usuario');
                return 'Error';
            }
        }
        // [FIN]
    },


    save: function(button, e, eOpts) {
        var me = this,
                grid = me.getUsuarioBeneficiarioLista(),
                store = grid.getStore(),
                win = button.up('window'),
                form = win.down('form'),
                record = form.getRecord(),
                values = form.getValues();
        
        record.set(values);
        
        var currentDate = new Date();
        
        record.set('fecha_asignacion_usuario_beneficiario', currentDate);
        record.set('estado_usuario_beneficiario', 1);

        var store1 = Ext.data.StoreManager.lookup('usuario.UsuarioBeneficiarioGestion');
        var rec1 = store1.findRecord('id_beneficiario', values.fk_id_beneficiario);
        var data1 = rec1.getData();
        var dd2 = data1.id_gestion_beneficiario;
        record.set('fk_id_gestion_beneficiario', dd2);

        // check if form is even dirty...if not, just close window and stop everything...nothing to see here
        if (!record.dirty) {
            win.close();
            return;
        }

        if ( form.isValid() )
        {
            // si es nuevo registro se lo añade al store, sino se lo actualiza
            var rowIndex = store.indexOf(record);
            ( rowIndex === -1 ) ? store.add(record) : form.updateRecord(record);

            win.close();
        }
        else
        {
            Ext.Msg.alert('Error de Validación', 'Por favor revise los datos del formulario.');
            return;
        }
    },
            

    close: function(button, e, eOpts) {
        var win = button.up('window');
        // close the window
        win.close();
    },


    remove: function() {
        var me = this;
        var grid = me.getUsuarioBeneficiarioLista();
        var store = grid.getStore();
        var record = grid.getSelectionModel().getSelection()[0];
        var contRaiz = me.getController('usuario.Usuario');

        // Se esta eliminando un registro del grid de Estado Civil
        // pero de un beneficiario nuevo. Solo se quita del store.
        if ( contRaiz.boolUsuarioEdit === 0 )
        {
            store.remove(record);
        }
        // Se esta eliminando un registro del grid de Estado Civil
        // pero de un beneficiario ya creado. Si es un registro recién creado (phantom == true)
        // solo se quita del store. Si no es un registro recién creado se lo quita del store
        // y de la base de datos (sync).
        else
        {
            if ( record.phantom )
            {
                store.remove(record);
            }
            else
            {
                Ext.Msg.confirm({
                    title: 'Atención',
                    msg: '¿Esta seguro que desea eliminar esta Asignación del Beneficiario al Usuario?. Esta acción no puede ser deshecha.',
                    icon: Ext.Msg.QUESTION,
                    buttonText: {
                        yes: 'Eliminar',
                        no: 'Cancelar'
                    },
                    fn: function(buttonId, text, opt) 
                    {
                        if (buttonId === 'yes') {
                            store.remove(record);
                        }
                    }
                });
            }
        }
    },


    showEditWindow: function(record) {
        var me = this,
                win = me.getUsuarioBeneficiarioWindow(),
                isNew = record.phantom;
        // if window exists, show it; otherwise, create new instance
        if (!win) {
            win = Ext.widget('usuario.edit.windowbeneficiario', {
                title: isNew ? 'Añadir Asignación de Beneficiarios a Usuario' : 'Editar Asignación de Beneficiarios a Usuario'
            });
        }
        // show window
        win.show();
        // load form with data
        win.down('form').loadRecord(record);
        win.doComponentLayout();
    },


    sincronizar: function() {
        var me = this,
                grid = me.getUsuarioBeneficiarioLista(),
                store = grid.getStore();
        
        store.sync();
    }
});