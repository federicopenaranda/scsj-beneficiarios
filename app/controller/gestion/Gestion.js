Ext.define('sisscsj.controller.gestion.Gestion',{
    extend:'sisscsj.controller.Base',
    stores: [
            'gestion.Gestion'
    ],
    views: [
            'gestion.Lista'
    ],
    refs: [
         {
           ref: 'GestionLista',
           selector:'[xtype=gestion.lista]'
         }
     ],
    init:function(){
	  this.listen({
	   	 controller:{},
	   	 component:{
		'grid[xtype=gestion.lista]': {
                    edit: this.save,
                    canceledit: this.cancel,
                    beforerender: this.loadRecords,
                    itemdblclick: this.edit,
                    selectionchange: this.manejaBotones,
                    afterrender: this.manejaBotones
                },
                'grid[xtype=gestion.lista] button#add': {
                    click: this.add
                },
                'grid[xtype=gestion.lista] button#edit': {
                    click: this.edit2
                },
                'grid[xtype=gestion.lista] button#delete': {
                    click: this.remove
                },
                'grid[xtype=gestion.lista] gridview': {
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
        store.clearFilter(true);
        store.load();
    },


    manejaBotones: function ( record, index, eOpts ){
        var me = this;
        var grid = me.getGestionLista();
        var records = grid.getSelectionModel().getSelection();

        var botonEdit = grid.down("[xtype='toolbar'] button#edit");
        var botonDelete = grid.down("[xtype='toolbar'] button#delete");
        var botonInscripcion = grid.down("[xtype='toolbar'] button#inscripcion");

        if (records.length > 0)
        {
            botonEdit.enable();
            botonDelete.enable();
            botonInscripcion.enable();
        }
        else
        {
            botonEdit.disable();
            botonDelete.disable();
            botonInscripcion.disable();
        }
    },


    cancel: function(editor, context, eOpts) {
        if (context.record.phantom) {
            context.store.remove(context.record);
        }
    },


    edit: function(records, index, node, eOpts) {
        var me = this,
                grid = me.getGestionLista(),
                plugin = grid.editingPlugin;
        plugin.startEdit(records[ 0 ], 0);
    },


    edit2: function() {
        var me = this,
                grid = me.getGestionLista(),
                plugin = grid.editingPlugin,
                record = grid.getSelectionModel().getSelection()[0];

        plugin.startEdit(record, 0);
    },


    add: function(button, e, eOpts) {
        var me = this,
                grid = me.getGestionLista(),
                plugin = grid.editingPlugin,
                store = grid.getStore();

        if (plugin.editing) {
            Ext.Msg.alert('Atención', 'Por favor termine de editar antes de ingresar un nuevo registro.');
            return false;
        }
                
        store.insert(0, {});
    },


    save: function(editor, context, eOpts) {
        var me = this,
                store = context.record.store;
        store.save();
    },


    remove: function(record) {
        var me = this;

        var grid = me.getGestionLista();
        var store = grid.getStore();
        var record = grid.getSelectionModel().getSelection()[0];
        
        Ext.Msg.confirm({
            title: 'Atención',
            msg: '¿Esta seguro que desea eliminar esta Gestión?. Esta acción no puede ser deshecha. \n <strong>Advertencia: Se eliminarán también todas las inscripciones a esta gestión.</strong>',
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
                    })
                }
            }
        });
    }
});


