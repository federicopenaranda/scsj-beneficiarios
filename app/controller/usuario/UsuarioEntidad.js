Ext.define('sisscsj.controller.usuario.UsuarioEntidad', {
    extend: 'sisscsj.controller.Base',
    stores: [
        'usuario.UsuarioEntidad'
    ],
    views: [
        'usuario.ListaEntidad',
        'usuario.Lista'
    ],
    refs: [
        {
            ref: 'UsuarioEntidadLista',
            selector: '[xtype=usuario.listaentidad]'
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
                'grid[xtype=usuario.listaentidad]': {
                    beforerender: this.loadRecords,
                    itemdblclick: this.edit,
                    select: this.habilitarBotones,
                    delselect: this.deshabilitarBotones
                },
                'grid[xtype=usuario.listaentidad] button#add': {
                    click: this.add
                },
                'grid[xtype=usuario.listaentidad] button#edit': {
                    click: this.edit2
                },
                'grid[xtype=usuario.listaentidad] button#delete': {
                    click: this.remove
                },
                'grid[xtype=usuario.listaentidad] gridview': {
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
        var contRaiz = me.getController('usuario.Usuario');
        
        // Se esta editando un usuario
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
        var grid = me.getUsuarioEntidadLista();
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
        var grid = me.getUsuarioLista();
        var records = grid.getSelectionModel().getSelection();

        if (records.length > 0)
        {
            var grid2 = me.getUsuarioEntidadLista();
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
                grid = me.getUsuarioEntidadLista(),
                plugin = grid.editingPlugin;
        // start edit of row
        plugin.startEdit(records[ 0 ], 0);
    },


    edit2: function() {
        var me = this,
                grid = me.getUsuarioEntidadLista(),
                plugin = grid.editingPlugin;

        var record = grid.getSelectionModel().getSelection()[0];
        // start edit of row
        plugin.startEdit(record, 0);
    },


    add: function(button, e, eOpts) {
        var me = this,
            record = Ext.create('sisscsj.model.usuario.UsuarioEntidad');
        
        // [INICIO] Se recupera el ID del registro raiz para asociarlo al registro actual
        var grid1 = me.getUsuarioLista();
        var recSeleccionados = grid1.getSelectionModel().getSelection();
        
        var grid2 = me.getUsuarioEntidadLista();
        var store2 = grid2.getStore();
        var contRaiz = me.getController('usuario.Usuario');

        // Usuario ya creado
        if ( recSeleccionados.length === 1 && contRaiz.boolUsuarioEdit === 1 )
        {
            var record1 = recSeleccionados[0];
            var data1 = record1.getData();

            record.set('fk_id_usuario', data1['id_usuario']);

            store2.insert(0, record);
            grid2.cellEditing.startEditByPosition({
                row: 0, 
                column: 0
            });
        }
        else
        {
            // Usuario nuevo
            if ( contRaiz.boolUsuarioEdit === 0 )
            {
                store2.insert(0, record);
                grid2.cellEditing.startEditByPosition({
                    row: 0, 
                    column: 0
                });
            }
            else
            {
                console.log('[UsuarioEntidad] Error al recuperar el ID del usuario');
                return 'Error';
            }
        }
        // [FIN]
    },


    remove: function( button, e, eOpts ) {
        var me = this;
        var grid = me.getUsuarioEntidadLista();
        var store = grid.getStore();
        var record = grid.getSelectionModel().getSelection()[0];
        var botonEdit = grid.down("[xtype='toolbar'] button#edit");
        var botonDelete = grid.down("[xtype='toolbar'] button#delete");
        var contRaiz = me.getController('usuario.Usuario');
        
        // Se esta eliminando un registro del grid de Estado Civil
        // pero de un usuario nuevo. Solo se quita del store.
        if ( contRaiz.boolUsuarioEdit === 0 )
        {
            store.remove(record);
        }
        // Se esta eliminando un registro del grid de Estado Civil
        // pero de un usuario ya creado. Si es un registro recién creado (phantom == true)
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
                    msg: '¿Esta seguro que desea eliminar esta asignación del Usuario a la Entidad?. Esta acción no puede ser deshecha.',
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
                grid = me.getUsuarioEntidadLista(),
                store = grid.getStore();

        store.sync();
    }
});