Ext.define('sisscsj.controller.entidad.EntidadEstado', {
    extend: 'sisscsj.controller.Base',
    stores: [
        'entidad.EntidadEstadoEntidad'
    ],
    views: [
        'entidad.ListaEntidadEstadoEntidad',
        'entidad.Lista'
    ],
    refs: [
        {
            ref: 'EntidadEstadoLista',
            selector: '[xtype=entidad.listaentidadestadoentidad]'
        },
        {
            ref: 'EntidadLista',
            selector: '[xtype=entidad.lista]'
        }
    ],
    init: function() {
        this.listen({
            controller: {},
            component: {
                'grid[xtype=entidad.listaentidadestadoentidad]': {
                    beforerender: this.loadRecords,
                    itemdblclick: this.edit,
                    select: this.habilitarBotones,
                    delselect: this.deshabilitarBotones
                },
                'grid[xtype=entidad.listaentidadestadoentidad] button#add': {
                    click: this.add
                },
                'grid[xtype=entidad.listaentidadestadoentidad] button#edit': {
                    click: this.edit2
                },
                'grid[xtype=entidad.listaentidadestadoentidad] button#delete': {
                    click: this.remove
                },
                'grid[xtype=entidad.listaentidadestadoentidad] gridview': {
                    itemadd: this.edit
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
        var botonEdit = grid.down("[xtype='toolbar'] button#edit");
        var botonDelete = grid.down("[xtype='toolbar'] button#delete");
        // clear any fliters that have been applied
        store.clearFilter(true);
        var contEntidad = me.getController('entidad.Entidad');
        
        // Se esta editando un entidad
        if ( contEntidad.boolEntidadEdit === 1)
        {
            var grid2 = me.getEntidadLista();
            var dd = grid2.getSelectionModel().getSelection();

            if ( dd.length === 1 )
            {
                var record = dd[0];
                var data = record.getData();

                store.filter( 'fk_id_entidad', data['id_entidad'] );
            }
        }
        
        // Se deshabilita o habilita los botones de edit y delete
        // según se haya elegido un registro o no.
        var recStore = store.getRange();
        var arrRecords = grid.getSelectionModel().getSelection();

        if ( recStore.length === 0 || arrRecords.length === 0 )
        {
            botonEdit.disable();
            botonDelete.disable();
        }
    },
    
    
    habilitarBotones: function ( record, index, eOpts ){
        var me = this;
        var grid = me.getEntidadEstadoLista();
        var botonEdit = grid.down("[xtype='toolbar'] button#edit");
        var botonDelete = grid.down("[xtype='toolbar'] button#delete");

        if ( botonEdit.disabled || botonDelete.disabled )
        {
            botonEdit.enable();
            botonDelete.enable();
        }
    },
    
    deshabilitarBotones: function ( record, index, eOpts ){
        var me = this;
        var grid = me.getEntidadLista();
        var records = grid.getSelectionModel().getSelection();

        if (records.length > 0)
        {
            var grid2 = me.getEntidadEstadoLista();
            var botonEdit = grid2.down("[xtype='toolbar'] button#edit");
            var botonDelete = grid2.down("[xtype='toolbar'] button#delete");

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
        var me = this,
                grid = me.getEntidadEstadoLista(),
                plugin = grid.editingPlugin;
        // start edit of row
        plugin.startEdit(records[ 0 ], 0);
    },


    edit2: function() {
        var me = this,
                grid = me.getEntidadEstadoLista(),
                plugin = grid.editingPlugin;

        var record = grid.getSelectionModel().getSelection()[0];
        // start edit of row
        plugin.startEdit(record, 0);
    },


    add: function(button, e, eOpts) {
        var me = this,
            record = Ext.create('sisscsj.model.entidad.EntidadEstadoEntidad');
        
        // [INICIO] Se recupera el ID del entidad para asociarlo al registro de Teléfono
        var grid1 = me.getEntidadLista();
        var recSeleccionados = grid1.getSelectionModel().getSelection();
        
        var grid2 = me.getEntidadEstadoLista();
        var store2 = grid2.getStore();
        var contEntidad = me.getController('entidad.Entidad');

        // Entidad ya creado
        if ( recSeleccionados.length === 1 && contEntidad.boolEntidadEdit === 1 )
        {
            var record1 = recSeleccionados[0];
            var data1 = record1.getData();

            record.set('fk_id_entidad', data1['id_entidad']);

            store2.insert(0, record);
            grid2.cellEditing.startEditByPosition({
                row: 0, 
                column: 0
            });
        }
        else
        {
            // Entidad nuevo
            if ( contEntidad.boolEntidadEdit === 0 )
            {
                store2.insert(0, record);
                grid2.cellEditing.startEditByPosition({
                    row: 0, 
                    column: 0
                });
            }
            else
            {
                console.log('[EntidadEstado] Error al recuperar el ID del entidad');
                return 'Error';
            }
        }
        // [FIN]
    },


    remove: function( button, e, eOpts ) {
        var me = this;
        var grid = me.getEntidadEstadoLista();
        var store = grid.getStore();
        var record = grid.getSelectionModel().getSelection()[0];
        var botonEdit = grid.down("[xtype='toolbar'] button#edit");
        var botonDelete = grid.down("[xtype='toolbar'] button#delete");
        var contEntidad = me.getController('entidad.Entidad');
        
        // Se esta eliminando un registro del grid de Teléfonos
        // pero de un entidad nuevo. Solo se quita del store.
        if ( contEntidad.boolEntidadEdit === 0 )
        {
            store.remove(record);
        }
        // Se esta eliminando un registro del grid de Teléfonos
        // pero de un Entidad ya creado. Si es un registro recién creado (phantom == true)
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
                    msg: '¿Esta seguro que desea eliminar este Teléfono?. Esta acción no puede ser deshecha.',
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
                grid = me.getEntidadEstadoLista(),
                store = grid.getStore();
        
        store.sync();
    }
});