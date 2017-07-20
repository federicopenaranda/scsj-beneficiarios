Ext.define('sisscsj.controller.evaluaciones.Computacion', {
    extend: 'sisscsj.controller.Base',
    stores: [
        'evaluaciones.Computacion'
    ],
    views: [
        'evaluaciones.Computacion.Lista',
        'evaluaciones.Computacion.edit.Form',
        'evaluaciones.Computacion.edit.Window'
    ],
    refs: [
        {
            ref: 'ComputacionLista',
            selector: '[xtype=evaluaciones.computacion.lista]'
        },
        {
            ref: 'ComputacionWindow',
            selector: '[xtype=evaluaciones.computacion.edit.window]'
        },
        {
            ref: 'ComputacionWindowEvaluacion',
            selector: '[xtype=evaluaciones.computacion.edit.windowevaluacion]'
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
                /////////////////////////////////////////////
                // [INICIO] Evaluaciones
                /////////////////////////////////////////////
                'grid[xtype=beneficiario.lista] menuitem#eval_computacion': {
                    click: this.add
                },
                'grid[xtype=evaluaciones.computacion.lista]': {
                    beforerender: this.loadRecords,
                    itemdblclick: this.editEvaluacion,
                    selectionchange: this.manejaBotones,
                    afterrender: this.manejaBotones
                },
                'grid[xtype=evaluaciones.computacion.lista] button#add': {
                    click: this.addEvaluacion
                },
                'grid[xtype=evaluaciones.computacion.lista] button#edit': {
                    click: this.editEvaluacion
                },
                'grid[xtype=evaluaciones.computacion.lista] button#delete': {
                    click: this.deleteEvaluacion
                },
                'window[xtype=evaluaciones.computacion.edit.windowevaluacion] button#save': {
                    click: this.save
                },
                'window[xtype=evaluaciones.computacion.edit.windowevaluacion] button#cancel': {
                    click: this.close
                }
                /////////////////////////////////////////////
                // [FIN] Evaluaciones
                /////////////////////////////////////////////
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

        var grid2 = me.getBeneficiarioLista();
        var record = grid2.getSelectionModel().getSelection()[0];
        var data = record.getData();
        
        store.filter( "fk_id_beneficiario", data['id_beneficiario'] );
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
    editEvaluacion: function(view, record, item, index, e, eOpts) {
        var me = this;

        var grid = me.getComputacionLista();
        var record = grid.getSelectionModel().getSelection()[0];
        // show window
        me.showEditWindowEvaluacion(record);
    },

    
    /**
     * Creates a new record and prepares it for editing
     * @param {Ext.button.Button} button
     * @param {Ext.EventObject} e
     * @param {Object} eOpts
     */
    add: function( view, record, item, index, e, eOpts ) {
        var me = this;
        
        var grid = me.getBeneficiarioLista();
        var record = grid.getSelectionModel().getSelection()[0];

        // show window
        me.showEditWindow(record);
    },
    
    addEvaluacion: function(button, e, eOpts) {
        var me = this,
                record = Ext.create('sisscsj.model.evaluaciones.Computacion');

        // show window
        me.showEditWindowEvaluacion(record);
    },


    manejaBotones: function ( record, index, eOpts ){
        var me = this;
        var grid = me.getComputacionLista();
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
     * Persists edited record
     * @param {Ext.button.Button} button
     * @param {Ext.EventObject} e
     * @param {Object} eOpts
     */
    save: function(button, e, eOpts) {
        var me = this,
                grid = me.getComputacionLista(),
                store = grid.getStore(),
                win = button.up('window'),
                form = win.down('form'),
                record = form.getRecord(),
                values = form.getValues(),
                callbacks;
        
        var gridBeneficiario = me.getBeneficiarioLista();
        var recordBeneficiario = gridBeneficiario.getSelectionModel().getSelection()[0];
        var dataBeneficiario = recordBeneficiario.getData();

        values['fk_id_beneficiario'] = dataBeneficiario['id_beneficiario'];

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
        Ext.getBody().mask('Guardando Evaluación en Computación ...');
        
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
    deleteEvaluacion: function() {
        var me = this;

        var grid = me.getComputacionLista();
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
                win = me.getComputacionWindow();
        
        // if window exists, show it; otherwise, create new instance
        if (!win) {
            win = Ext.widget('evaluaciones.computacion.edit.window', {
                title: 'Evaluaciones en Computación'
            });
        }
        // show window
        win.show();
        win.doComponentLayout();
    },
    
    showEditWindowEvaluacion: function(record) {
        var me = this,
                win = me.getComputacionWindowEvaluacion(),
                isNew = record.phantom;
        // if window exists, show it; otherwise, create new instance
        if (!win) {
            win = Ext.widget('evaluaciones.computacion.edit.windowevaluacion', {
                title: isNew ? 'Añadir Evaluación en Computación' : 'Editar Evaluación en Computación'
            });
        }
        // show window
        win.show();

        // load form with data
        win.down('form').loadRecord(record);
        win.doComponentLayout();
    }
});