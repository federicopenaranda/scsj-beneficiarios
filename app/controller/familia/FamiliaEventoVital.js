Ext.define('sisscsj.controller.familia.FamiliaEventoVital', {
    extend: 'sisscsj.controller.Base',
    stores: [
        'familia.FamiliaEventoVital'
    ],
    views: [
        'familia.ListaEventoVital',
        'familia.edit.FormEventoVital',
        'familia.edit.WindowEventoVital'
    ],
    refs: [
        {
            ref: 'FamiliaEventoVitalLista',
            selector: '[xtype=familia.eventovitallista]'
        },
        {
            ref: 'FamiliaEventoVitalWindow',
            selector: '[xtype=familia.edit.windoweventovital]'
        },
        {
            ref: 'FamiliaEventoVitalForm',
            selector: '[xtype=familia.edit.formeventovital]'
        },
        {
            ref: 'FamiliaLista',
            selector: '[xtype=familia.lista]'
        }
    ],
    init: function() {
        this.listen({
            controller: {},
            component: {
                'grid[xtype=familia.eventovitallista]': {
                    beforerender: this.loadRecords,
                    itemdblclick: this.edit,
                    selectionchange: this.manejaBotones,
                    afterrender: this.manejaBotones
                },
                'grid[xtype=familia.eventovitallista] button#add': {
                    click: this.add
                },
                'grid[xtype=familia.eventovitallista] button#edit': {
                    click: this.edit
                },
                'grid[xtype=familia.eventovitallista] button#delete': {
                    click: this.remove
                },
                'window[xtype=familia.edit.windoweventovital] button#save': {
                    click: this.save
                },
                'window[xtype=familia.edit.windoweventovital] button#cancel': {
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
        var contFamilia = me.getController('familia.Familia');
        
        // Si se esta editando una familia filtrar el evento vital por su ID
        if ( contFamilia.boolFamiliaEdit === 1)
        {
            var grid2 = me.getFamiliaLista();
            var dd = grid2.getSelectionModel().getSelection();

            if ( dd.length === 1 )
            {
                var record = dd[0];
                var data = record.getData();

                store.filter( 'fk_id_familia', data['id_familia'] );
            }
        }
    },


    manejaBotones: function ( record, index, eOpts ){
        var me = this;
        var grid = me.getFamiliaEventoVitalLista();
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

        var grid = me.getFamiliaEventoVitalLista();
        var record = grid.getSelectionModel().getSelection()[0];
        // show window
        me.showEditWindow(record);
    },


    add: function(button, e, eOpts) {
        var me = this,
            record = Ext.create('sisscsj.model.familia.FamiliaEventoVital');
        
        // [INICIO] Se recupera el ID de la familia para asociarlo al registro de Evento Vital
        var grid1 = me.getFamiliaLista();
        var recSeleccionados = grid1.getSelectionModel().getSelection();
        var contFamilia = me.getController('familia.Familia');

        // Beneficiario ya creado
        if ( recSeleccionados.length === 1 && contFamilia.boolFamiliaEdit === 1 )
        {
            var record1 = recSeleccionados[0];
            var data1 = record1.getData();

            record.set('fk_id_familia', data1['id_familia']);

            me.showEditWindow(record);
        }
        else
        {
            // Beneficiario nuevo
            if ( contFamilia.boolFamiliaEdit === 0 )
            {
                me.showEditWindow(record);
            }
            else
            {
                console.log('[FamiliaEventoVital] Error al recuperar el ID de la familia');
                return 'Error';
            }
        }
        // [FIN]
    },


    save: function(button, e, eOpts) {
        var me = this,
                grid = me.getFamiliaEventoVitalLista(),
                store = grid.getStore(),
                win = button.up('window'),
                form = win.down('form'),
                record = form.getRecord(),
                values = form.getValues();

        // set values of record from form
        record.set(values);

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
        var me = this,
                win = button.up('window');
        // close the window
        win.close();
    },


    remove: function() {
        var me = this;
        var grid = me.getFamiliaEventoVitalLista();
        var store = grid.getStore();
        var record = grid.getSelectionModel().getSelection()[0];

        var contFamilia = me.getController('familia.Familia');

        // Se esta eliminando un registro del grid de Estado Civil
        // pero de un beneficiario nuevo. Solo se quita del store.
        if ( contFamilia.boolFamiliaEdit === 0 )
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
                    msg: '¿Esta seguro que desea eliminar este Evento Vital?. Esta acción no puede ser deshecha.',
                    icon: Ext.Msg.QUESTION,
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
                win = me.getFamiliaEventoVitalWindow(),
                isNew = record.phantom;
        // if window exists, show it; otherwise, create new instance
        if (!win) {
            win = Ext.widget('familia.edit.windoweventovital', {
                title: isNew ? 'Añadir Evento Vital' : 'Editar Evento Vital'
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
                grid = me.getFamiliaEventoVitalLista(),
                store = grid.getStore();
        
        store.sync();
    }
});