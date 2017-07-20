Ext.define('sisscsj.controller.opciones.Vacuna',{
   extend:'sisscsj.controller.Base',
   stores: [
   	   'opciones.Vacuna'
   ],
   views: [
	   'opciones.Vacuna.Lista'
   ],
   refs: [
	{
	  ref: 'VacunaLista',
          selector:'[xtype=opciones.vacuna.lista]'
	}
   ],
	init:function(){
	  this.listen({
	   	 controller:{},
	   	 component:{
		'grid[xtype=opciones.vacuna.lista]': {
                    edit: this.save,
                    canceledit: this.cancel,
                    beforerender: this.loadRecords,
                    selectionchange: this.manejaBotones,
                    afterrender: this.manejaBotones
                },
                'grid[xtype=opciones.vacuna.lista] button#add': {
                    click: this.add
                },
                'grid[xtype=opciones.vacuna.lista] button#edit': {
                    click: this.edit2
                },
                'grid[xtype=opciones.vacuna.lista] button#delete': {
                    click: this.remove
                },
                'grid[xtype=opciones.vacuna.lista] gridview': {
                    itemadd: this.edit
                }
            },
            global: {},
            store: {},
            proxy: {}
        });
    },


    manejaBotones: function ( record, index, eOpts ){
        var me = this;
        var grid = me.getVacunaLista();
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

    /**
     * Loads the grid's store
     * @param {Ext.grid.Panel}
     * @param {Object}
     */
    loadRecords: function(grid, eOpts) {
        var me = this,
                store = grid.getStore();
        // clear any fliters that have been applied
        store.clearFilter(true);
        // load the store
        store.load();
    },
    /**
     * Cancels the edit of a record
     * @param {Ext.grid.plugin.Editing} editor
     * @param {Object} context
     * @param {Object} eOpts
     * @param {}
     * @param {}
     * @param {}
     */
    cancel: function(editor, context, eOpts) {
        // if the record is a phantom, remove from store and grid
        if (context.record.phantom) {
            context.store.remove(context.record);
        }
    },
    /**
     * Begins edit of selected record
     * @param {Ext.data.Model[]} records
     * @param {Number} index
     * @param {Object} node
     * @param {Object} eOpts
     */
    edit: function(records, index, node, eOpts) {
        var me = this,
                grid = me.getVacunaLista(),
                plugin = grid.editingPlugin;
        // start edit of row
        plugin.startEdit(records[ 0 ], 0);
    },
    /**
     * Begins edit of selected record
     * @param {Ext.data.Model[]} records
     * @param {Number} index
     * @param {Object} node
     * @param {Object} eOpts
     */
    edit2: function() {
        var me = this,
                grid = me.getVacunaLista(),
                plugin = grid.editingPlugin;

        var record = grid.getSelectionModel().getSelection()[0];
        // start edit of row
        plugin.startEdit(record, 0);
    },
    /**
     * Creates a new record and prepares it for editing
     * @param {Ext.button.Button} button
     * @param {Ext.EventObject} e
     * @param {Object} eOpts
     */
    add: function(button, e, eOpts) {
        var me = this,
                grid = me.getVacunaLista(),
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
    /**
     * Displays context menu 
     * @param {Ext.grid.plugin.Editing} editor
     * @param {Object} context
     * @param {Object} eOpts
     */
    save: function(editor, context, eOpts) {
        var me = this,
                store = context.record.store;
        // save
        store.save();
    },
    /**
     * Displays context menu 
     * @param {Ext.data.Model[]} record
     */
    remove: function(record) {
        var me = this;

        var grid = me.getVacunaLista();
        var store = grid.getStore();
        var record = grid.getSelectionModel().getSelection()[0];

        // show confirmation before continuing
        Ext.Msg.confirm('Atención', '¿Esta seguro que desea eliminar esta Vacuna?. Esta acción no puede ser deshecha.', function(buttonId, text, opt) {
            if (buttonId == 'yes') {
                store.remove(record);
                store.sync({
                    /**
                     * On failure, add record back to store at correct index
                     * @param {Ext.data.Model[]} records
                     * @param {Ext.data.Operation} operation
                     */
                    failure: function(records, operation) {
                        store.rejectChanges();
                    }
                })
            }
        })
    }
});


