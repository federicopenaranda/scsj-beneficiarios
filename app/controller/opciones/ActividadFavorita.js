Ext.define('sisscsj.controller.opciones.ActividadFavorita',{
    extend:'sisscsj.controller.Base',
    stores: [
        'opciones.ActividadFavorita'
    ],
    views: [
        'opciones.ActividadFavorita.Lista'
    ],
    refs: [
        {
            ref: 'ActividadFavoritaLista',
            selector:'[xtype=opciones.actividadfavorita.lista]'
        }
    ],
    init:function(){
        this.listen({
            controller:{},
            component:{
		'grid[xtype=opciones.actividadfavorita.lista]': {
                    edit: this.save,
                    canceledit: this.cancel,
                    beforerender: this.loadRecords,
                    selectionchange: this.manejaBotones,
                    afterrender: this.manejaBotones
                },
                'grid[xtype=opciones.actividadfavorita.lista] button#add': {
                    click: this.add
                },
                'grid[xtype=opciones.actividadfavorita.lista] button#edit': {
                    click: this.edit2
                },
                'grid[xtype=opciones.actividadfavorita.lista] button#delete': {
                    click: this.remove
                },
                'grid[xtype=opciones.actividadfavorita.lista] gridview': {
                    itemadd: this.edit
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


    manejaBotones: function ( record, index, eOpts ){
        var me = this;
        var grid = me.getActividadFavoritaLista();
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
        var me = this,
                grid = me.getActividadFavoritaLista(),
                plugin = grid.editingPlugin;
        // start edit of row
        plugin.startEdit(records[ 0 ], 0);
    },


    edit2: function() {
        var me = this,
                grid = me.getActividadFavoritaLista(),
                plugin = grid.editingPlugin;

        var record = grid.getSelectionModel().getSelection()[0];
        // start edit of row
        plugin.startEdit(record, 0);
    },


    add: function(button, e, eOpts) {
        var me = this,
                grid = me.getActividadFavoritaLista(),
                plugin = grid.editingPlugin,
                store = grid.getStore();
        // if we're already editing, don't allow new record insert
        if (plugin.editing) {
            // show error message
            Ext.Msg.alert('Atención', 'Por favor termine de editar antes de ingresar un nuevo registro.');
            return false;
        }
        store.insert(0, {});
    },


    save: function(editor, context, eOpts) {
        var store = context.record.store,
            callbacks;

        callbacks = {
            success: function(records, operation) {
                store.reload();
            },
            failure: function(records, operation) {
                store.rejectChanges();
            }
        };
        
        // save
        store.sync(callbacks);
    },


    remove: function() {
        var me = this;

        var grid = me.getActividadFavoritaLista();
        var store = grid.getStore();
        var record = grid.getSelectionModel().getSelection()[0];

        Ext.Msg.confirm({
            title: 'Atención',
            msg: '¿Esta seguro que desea eliminar esta ActividadFavorita?. Esta acción no puede ser deshecha.',
            icon: Ext.Msg.QUESTION,
            buttonText: {
                yes: 'Eliminar',
                no: 'Cancelar'
            },
            fn: function(buttonId, text, opt) 
            {
                if (buttonId === 'yes') {
                    store.remove(record);
                    store.sync({
                        failure: function(records, operation) {
                            store.rejectChanges();
                        }
                    });
                    store.reload();
                }
            }
        });
    }
});