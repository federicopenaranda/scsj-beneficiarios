Ext.define('sisscsj.controller.evaluaciones.Biblioteca', {
    extend: 'sisscsj.controller.Base',
    stores: [
        'evaluaciones.Biblioteca'
    ],
    views: [
        'evaluaciones.Biblioteca.Lista',
        'evaluaciones.Biblioteca.edit.Form',
        'evaluaciones.Biblioteca.edit.Window'
    ],
    refs: [
        {
            ref: 'BibliotecaLista',
            selector: '[xtype=evaluaciones.biblioteca.lista]'
        },
        {
            ref: 'BibliotecaWindow',
            selector: '[xtype=evaluaciones.biblioteca.edit.window]'
        },
        {
            ref: 'BibliotecaWindowEvaluacion',
            selector: '[xtype=evaluaciones.biblioteca.edit.windowevaluacion]'
        },
        {
            ref: 'BibliotecaWindowRep1',
            selector: '[xtype=evaluaciones.biblioteca.edit.windowrep1]'
        },
        {
            ref: 'BibliotecaFormRep1',
            selector: '[xtype=evaluaciones.biblioteca.edit.formrep1]'
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
                'grid[xtype=beneficiario.lista] button#eval_biblioteca': {
                    click: this.add
                },
                'grid[xtype=evaluaciones.biblioteca.lista]': {
                    beforerender: this.loadRecords,
                    itemdblclick: this.editEvaluacion,
                    selectionchange: this.manejaBotones,
                    afterrender: this.manejaBotones
                },
                'grid[xtype=evaluaciones.biblioteca.lista] button#add': {
                    click: this.addEvaluacion
                },
                'grid[xtype=evaluaciones.biblioteca.lista] button#edit': {
                    click: this.editEvaluacion
                },
                'grid[xtype=evaluaciones.biblioteca.lista] button#delete': {
                    click: this.deleteEvaluacion
                },
                'grid[xtype=evaluaciones.biblioteca.lista] menuitem#reporteGeneral': {
                    click: this.repBiblioteca1
                },
                'window[xtype=evaluaciones.biblioteca.edit.windowevaluacion] button#save': {
                    click: this.save
                },
                'window[xtype=evaluaciones.biblioteca.edit.windowevaluacion] button#cancel': {
                    click: this.close
                },
                'window[xtype=evaluaciones.biblioteca.edit.windowrep1] button#save': {
                    click: this.repBiblioteca
                },
                'window[xtype=evaluaciones.biblioteca.edit.windowrep1] button#cancel': {
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
    
    
    repBiblioteca1: function () {
        var me = this,
                win = me.getBibliotecaWindowRep1();
        
        if (!win) {
            win = Ext.widget('evaluaciones.biblioteca.edit.windowrep1', {
                title: 'Parámetros de Reporte'
            });
        }
        // show window
        win.show();
        win.doComponentLayout();
    },
    
    
    repBiblioteca: function () {
        var me = this,
                form = me.getBibliotecaFormRep1(),
                win = me.getBibliotecaWindowRep1(),
                obj, src, values;
        
        if ( !form.isValid() )
        {
            Ext.Msg.alert('Error de Validación', 'Por favor revise los datos del formulario.');
            return;
        }
        else
        {
            values = form.getValues();

            obj = {
                url: sisscsj.app.globals.globalServerPath + 'reporte/reporte1',
                params: {
                    start: values.fecha_inicio,
                    limit: values.fecha_fin
                }
                
            };

            src = obj.url + (obj.params ? '?' + Ext.urlEncode(obj.params) : '');

            Ext.core.DomHelper.append(document.body, {
                tag : 'iframe',
                id : 'downloadIframe',
                frameBorder : 0,
                width : 0,
                height : 0,
                css : 'display:none;visibility:hidden;height:0px;',
                src : src
            });
            
            win.close();
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
    editEvaluacion: function(view, record, item, index, e, eOpts) {
        var me = this;

        var grid = me.getBibliotecaLista();
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

        // show window
        me.showEditWindow();
    },
    
    addEvaluacion: function(button, e, eOpts) {
        var me = this,
                record = Ext.create('sisscsj.model.evaluaciones.Biblioteca');

        // show window
        me.showEditWindowEvaluacion(record);
    },


    manejaBotones: function ( record, index, eOpts ){
        var me = this;
        var grid = me.getBibliotecaLista();
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
                grid = me.getBibliotecaLista(),
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
        Ext.getBody().mask('Guardando Consulta Bibliográfica ...');
        
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

        var grid = me.getBibliotecaLista();
        var store = grid.getStore();
        var record = grid.getSelectionModel().getSelection()[0];
        
        // show confirmation before continuing
        Ext.Msg.confirm('Atención', '¿Esta seguro que desea eliminar este registro?. Esta acción no puede ser deshecha.', function(buttonId, text, opt) {
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
                win = me.getBibliotecaWindow();
        
        // if window exists, show it; otherwise, create new instance
        if (!win) {
            win = Ext.widget('evaluaciones.biblioteca.edit.window', {
                title: 'Consultas Bibliográficas'
            });
        }
        // show window
        win.show();
        win.doComponentLayout();
    },
    
    showEditWindowEvaluacion: function(record) {
        var me = this,
                win = me.getBibliotecaWindowEvaluacion(),
                isNew = record.phantom;
        // if window exists, show it; otherwise, create new instance
        if (!win) {
            win = Ext.widget('evaluaciones.biblioteca.edit.windowevaluacion', {
                title: isNew ? 'Añadir Consulta Bibliográfica' : 'Editar Consulta Bibliográfica'
            });
        }
        // show window
        win.show();

        // load form with data
        win.down('form').loadRecord(record);
        win.doComponentLayout();
    }
});