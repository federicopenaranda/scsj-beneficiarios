Ext.define('sisscsj.controller.beneficiario.BeneficiarioTipoIdentificacion', {
    extend: 'sisscsj.controller.Base',
    stores: [
        'beneficiario.BeneficiarioTipoIdentificacion'
    ],
    views: [
        'beneficiario.ListaTipoIdentificacion',
        'beneficiario.Lista'
    ],
    refs: [
        {
            ref: 'BeneficiarioTipoIdentificacionLista',
            selector: '[xtype=beneficiario.listatipoidentificacion]'
        },
        {
            ref: 'BeneficiarioLista',
            selector: '[xtype=beneficiario.lista]'
        }
    ],
    init: function() {
        this.listen({
            controller: {},
            component: {
                'grid[xtype=beneficiario.listatipoidentificacion]': {
                    beforerender: this.loadRecords,
                    itemdblclick: this.edit,
                    selectionchange: this.manejaBotones,
                    afterrender: this.manejaBotones
                },
                'grid[xtype=beneficiario.listatipoidentificacion] button#add': {
                    click: this.add
                },
                'grid[xtype=beneficiario.listatipoidentificacion] button#edit': {
                    click: this.edit2
                },
                'grid[xtype=beneficiario.listatipoidentificacion] button#delete': {
                    click: this.remove
                },
                'grid[xtype=beneficiario.listatipoidentificacion] gridview': {
                    itemadd: this.edit
                }
            },
            global: {},
            store: {},
            proxy: {}
        });
    },


    manejaBotones: function ( record, index, eOpts ){
        var me = this,
                grid = me.getBeneficiarioTipoIdentificacionLista(),
                records = grid.getSelectionModel().getSelection(),
                botonEdit = grid.down("[xtype='toolbar'] button#edit"),
                botonDelete = grid.down("[xtype='toolbar'] button#delete");

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
        var me = this;
        var store = grid.getStore();

        // clear any fliters that have been applied
        store.clearFilter(true);
        var contBeneficiario = me.getController('beneficiario.Beneficiario');
        
        // Se esta editando un beneficiario
        if ( contBeneficiario.boolBeneficiarioEdit === 1)
        {
            var grid2 = me.getBeneficiarioLista();
            var dd = grid2.getSelectionModel().getSelection();

            if ( dd.length === 1 )
            {
                var record = dd[0];
                var data = record.getData();

                store.filter( 'fk_id_beneficiario', data['id_beneficiario'] );
            }
        }
    },


    cancel: function(editor, context, eOpts) {
        // if the record is a phantom, remove from store and grid
        if (context.record.phantom) {
            context.store.remove(context.record);
        }
    },


    edit: function(records, index, node, eOpts) {
        var me = this,
                grid = me.getBeneficiarioTipoIdentificacionLista(),
                plugin = grid.editingPlugin;
        // start edit of row
        plugin.startEdit(records[ 0 ], 0);
    },


    edit2: function() {
        var me = this,
                grid = me.getBeneficiarioTipoIdentificacionLista(),
                plugin = grid.editingPlugin;

        var record = grid.getSelectionModel().getSelection()[0];
        // start edit of row
        plugin.startEdit(record, 0);
    },


    add: function(button, e, eOpts) {
        var me = this,
            record = Ext.create('sisscsj.model.beneficiario.BeneficiarioTipoIdentificacion');

        // [INICIO] Se recupera el ID del beneficiario para asociarlo al registro del tipo de identificacion
        var grid1 = me.getBeneficiarioLista();
        var recSeleccionados = grid1.getSelectionModel().getSelection();
        
        var grid2 = me.getBeneficiarioTipoIdentificacionLista();
        var store2 = grid2.getStore();
        var contBeneficiario = me.getController('beneficiario.Beneficiario');

        // Beneficiario ya creado
        if ( recSeleccionados.length === 1 && contBeneficiario.boolBeneficiarioEdit === 1 )
        {
            var record1 = recSeleccionados[0];
            var data1 = record1.getData();

            record.set('fk_id_beneficiario', data1['id_beneficiario']);

            store2.insert(0, record);
            grid2.cellEditing.startEditByPosition({
                row: 0, 
                column: 0
            });
        }
        else
        {
            // Beneficiario nuevo
            if ( contBeneficiario.boolBeneficiarioEdit === 0 )
            {
                store2.insert(0, record);
                grid2.cellEditing.startEditByPosition({
                    row: 0, 
                    column: 0
                });
            }
            else
            {
                console.log('[BeneficiarioTipoIdentificacion] Error al recuperar el ID del beneficiario');
                return 'Error';
            }
        }
        // [FIN]
    },


    remove: function( button, e, eOpts ) {
        var me = this;
        var grid = me.getBeneficiarioTipoIdentificacionLista();
        var store = grid.getStore();
        var record = grid.getSelectionModel().getSelection()[0];
        var botonEdit = grid.down("[xtype='toolbar'] button#edit");
        var botonDelete = grid.down("[xtype='toolbar'] button#delete");
        var contBeneficiario = me.getController('beneficiario.Beneficiario');

        // Se esta eliminando un registro del grid de Tipo de Identificacion
        // pero de un beneficiario nuevo. Solo se quita del store.
        if ( contBeneficiario.boolBeneficiarioEdit === 0 )
        {
            store.remove(record);
        }
        // Se esta eliminando un registro del grid de Tipo de Identificación
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
                    msg: '¿Esta seguro que desea eliminar este Tipo de Identificación?. Esta acción no puede ser deshecha.',
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

        var recStore = store.getRange();
        var arrRecords = grid.getSelectionModel().getSelection();

        if ( recStore.length === 0 || arrRecords.length === 0 )
        {
            botonEdit.disable();
            botonDelete.disable();
        }
    },


    sincronizar: function() {
        var me = this,
                grid = me.getBeneficiarioTipoIdentificacionLista(),
                store = grid.getStore();

        store.sync();
    }
});