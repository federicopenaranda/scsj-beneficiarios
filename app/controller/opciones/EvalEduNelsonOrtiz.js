/**
 * Generic controller for managing simple options
 */
Ext.define('sisscsj.controller.opciones.EvalEduNelsonOrtiz', {
    extend: 'sisscsj.controller.Base',
    stores: [
        'opciones.EvalEduNelsonOrtiz'
    ],
    views: [
        'opciones.EvalEduNelsonOrtiz.Lista',
        'opciones.EvalEduNelsonOrtiz.edit.Form',
        'opciones.EvalEduNelsonOrtiz.edit.Window'
    ],
    refs: [
        {
            ref: 'EvalEduNelsonOrtizLista',
            selector: '[xtype=opciones.evaledunelsonortiz.lista]'
        },
        {
            ref: 'EvalEduNelsonOrtizWindow',
            selector: '[xtype=opciones.evaledunelsonortiz.edit.window]'
        },
        {
            ref: 'EvalEduNelsonOrtizForm',
            selector: '[xtype=opciones.evaledunelsonortiz.edit.form]'
        }
    ],
    init: function() {
        this.listen({
            controller: {},
            component: {
                'grid[xtype=opciones.evaledunelsonortiz.lista]': {
                    beforerender: this.loadRecords,
                    itemdblclick: this.edit
                },
                'grid[xtype=opciones.evaledunelsonortiz.lista] button#add': {
                    click: this.add
                },
                'grid[xtype=opciones.evaledunelsonortiz.lista] button#edit': {
                    click: this.edit
                },
                'grid[xtype=opciones.evaledunelsonortiz.lista] button#delete': {
                    click: this.remove
                },
                'window[xtype=opciones.evaledunelsonortiz.edit.window] button#save': {
                    click: this.save
                },
                'window[xtype=opciones.evaledunelsonortiz.edit.window] button#cancel': {
                    click: this.close
                }
            },
            global: {},
            store: {},
            proxy: {}
        });
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
     * Handles request to edit
     * @param {Ext.view.View} view
     * @param {Ext.data.Model} record 
     * @param {HTMLElement} item
     * @param {Number} index
     * @param {Ext.EventObject} e
     * @param {Object} eOpts
     */
    edit: function(view, record, item, index, e, eOpts) {
        var me = this;

        var grid = me.getEvalEduNelsonOrtizLista();
        var store = grid.getStore();
        var record = grid.getSelectionModel().getSelection()[0];
        // show window
        me.showEditWindow(record);
    },
    /**
     * Creates a new record and prepares it for editing
     * @param {Ext.button.Button} button
     * @param {Ext.EventObject} e
     * @param {Object} eOpts
     */
    add: function(button, e, eOpts) {
        var me = this,
                record = Ext.create('sisscsj.model.opciones.EvalEduNelsonOrtiz');
        // show window
        me.showEditWindow(record);
    },


    /**
     * Persists edited record
     * @param {Ext.button.Button} button
     * @param {Ext.EventObject} e
     * @param {Object} eOpts
     */
    save: function(button, e, eOpts) {
        var me = this,
                grid = me.getEvalEduNelsonOrtizLista(),
                store = grid.getStore(),
                win = button.up('window'),
                form = win.down('form'),
                record = form.getRecord(),
                values = form.getValues(),
                callbacks;
        
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
        Ext.getBody().mask('Guardando Evaluación Nelson Ortiz ...');
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

    /**
     * Persists edited record
     * @param {Ext.button.Button} button
     * @param {Ext.EventObject} e
     * @param {Object} eOpts
     */
    close: function(button, e, eOpts) {
        var me = this,
                win = button.up('window');
        // close the window
        win.close();
    },


    /**
     * Displays context menu 
     * @param {Ext.data.Model[]} record
     */
    remove: function() {
        var me = this;

        var grid = me.getEvalEduNelsonOrtizLista();
        var store = grid.getStore();
        var record = grid.getSelectionModel().getSelection()[0];
        
        // show confirmation before continuing
        Ext.Msg.confirm('Atención', '¿Esta seguro que desea eliminar esta Evaluación?. Esta acción no puede ser deshecha.', function(buttonId, text, opt) {
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
    },


    /**
     * Displays common editing form for add/edit operations
     * @param {Ext.data.Model} record
     */
    showEditWindow: function(record) {
        var me = this,
                win = me.getEvalEduNelsonOrtizWindow(),
                isNew = record.phantom;
        // if window exists, show it; otherwise, create new instance
        if (!win) {
            win = Ext.widget('opciones.evaledunelsonortiz.edit.window', {
                title: isNew ? 'Añadir Evaluación Nelson Ortiz' : 'Editar Evaluación Nelson Ortiz'
            });
        }
        // show window
        win.show();
        // load form with data
        win.down('form').loadRecord(record);
        win.doComponentLayout();
    }
});