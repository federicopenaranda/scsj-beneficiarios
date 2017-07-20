Ext.define('sisscsj.controller.evaluaciones.AtencionMedica', {
    extend: 'sisscsj.controller.Base',
    stores: [
        'evaluaciones.AtencionMedica'
    ],
    views: [
        'evaluaciones.AtencionMedica.Lista',
        'evaluaciones.AtencionMedica.edit.Form',
        'evaluaciones.AtencionMedica.edit.Window'
    ],
    refs: [
        {
            ref: 'AtencionMedicaLista',
            selector: '[xtype=evaluaciones.atencionmedica.lista]'
        },
        {
            ref: 'AtencionMedicaWindow',
            selector: '[xtype=evaluaciones.atencionmedica.edit.window]'
        },
        {
            ref: 'AtencionMedicaWindowEvaluacion',
            selector: '[xtype=evaluaciones.atencionmedica.edit.windowevaluacion]'
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
                'grid[xtype=beneficiario.lista] menuitem#eval_atencion_medica': {
                    click: this.add
                },
                'grid[xtype=evaluaciones.atencionmedica.lista]': {
                    beforerender: this.loadRecords,
                    itemdblclick: this.editEvaluacion,
                    selectionchange: this.manejaBotones,
                    afterrender: this.manejaBotones
                },
                'grid[xtype=evaluaciones.atencionmedica.lista] button#add': {
                    click: this.addEvaluacion
                },
                'grid[xtype=evaluaciones.atencionmedica.lista] button#edit': {
                    click: this.editEvaluacion
                },
                'grid[xtype=evaluaciones.atencionmedica.lista] button#delete': {
                    click: this.deleteEvaluacion
                },
                'window[xtype=evaluaciones.atencionmedica.edit.windowevaluacion] button#save': {
                    click: this.save
                },
                'window[xtype=evaluaciones.atencionmedica.edit.windowevaluacion] button#cancel': {
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
        
        // load the store
        /*var grid2 = me.getBeneficiarioLista();
        var record = grid2.getSelectionModel().getSelection()[0];
        var data = record.getData();
        
        store.getProxy().extraParams = {
            fk_id_beneficiario: data['id_beneficiario']
        };*/

        //store.load();
    },


    editEvaluacion: function(view, record, item, index, e, eOpts) {
        var me = this;

        var grid = me.getAtencionMedicaLista();
        var record = grid.getSelectionModel().getSelection()[0];
        
        // show window
        me.showEditWindowEvaluacion(record);
    },

    
    add: function( view, record, item, index, e, eOpts ) {
        var me = this;
        
        var grid = me.getBeneficiarioLista();
        var record = grid.getSelectionModel().getSelection()[0];

        // show window
        me.showEditWindow(record);
    },
    
    
    addEvaluacion: function(button, e, eOpts) {
        var me = this,
                record = Ext.create('sisscsj.model.evaluaciones.AtencionMedica');

        // show window
        me.showEditWindowEvaluacion(record);
    },


    manejaBotones: function ( record, index, eOpts ){
        var me = this;
        var grid = me.getAtencionMedicaLista();
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


    save: function(button, e, eOpts) {
        var me = this,
                grid = me.getAtencionMedicaLista(),
                store = grid.getStore(),
                win = button.up('window'),
                form = win.down('form'),
                record = form.getRecord(),
                values = form.getValues(),
                callbacks;
        
        if ( !form.isValid() )
        {
            Ext.Msg.alert('Error de Validación', 'Por favor revise los datos del formulario.');
            return;
        }
        else
        {
            var gridBeneficiario = me.getBeneficiarioLista();
            var recordBeneficiario = gridBeneficiario.getSelectionModel().getSelection()[0];
            var dataBeneficiario = recordBeneficiario.getData();

            values['fk_id_beneficiario'] = dataBeneficiario['id_beneficiario'];

            /////////////////////////////////////////////////////////////////
            // [INICIO] Procesamiento de campo Enfermedades Comunes
            /////////////////////////////////////////////////////////////////
            var arrayEnfermedades = []; // start with empty array
            var arrayLength = values['atencion_medica_enfermedad_comun'].length;
            for (var i = 0; i < arrayLength; i++) {
                // add the fields that you want to include
                var tmpEnfermedades = {
                    fk_id_enfermedad_comun: values['atencion_medica_enfermedad_comun'][i]
                };
                arrayEnfermedades.push(tmpEnfermedades); // push this to the array
            }
            var objEnfermedades = Ext.encode(arrayEnfermedades);
            values['atencion_medica_enfermedad_comun'] = objEnfermedades;
            /////////////////////////////////////////////////////////////////
            // [FIN] Procesamiento de campo Enfermedades Comunes
            /////////////////////////////////////////////////////////////////

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
            Ext.getBody().mask('Guardando Evaluación Médica ...');

            // if new record...
            if (record.phantom) {
                // reject any other changes
                store.rejectChanges();
                // add the new record
                store.add(record);
            }

            // persist the record
            store.sync(callbacks);
        }
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
     * Persists edited record
     * @param {Ext.button.Button} button
     * @param {Ext.EventObject} e
     * @param {Object} eOpts
     */
    deleteEvaluacion: function() {
        var me = this;

        var grid = me.getAtencionMedicaLista();
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
                win = me.getAtencionMedicaWindow();
        
        // if window exists, show it; otherwise, create new instance
        if (!win) {
            win = Ext.widget('evaluaciones.atencionmedica.edit.window', {
                title: 'Evaluaciones en Atención Médica'
            });
        }
        // show window
        win.show();
        win.doComponentLayout();
    },
    
    showEditWindowEvaluacion: function(record) {
        var me = this,
                win = me.getAtencionMedicaWindowEvaluacion(),
                isNew = record.phantom;
        // if window exists, show it; otherwise, create new instance
        if (!win) {
            win = Ext.widget('evaluaciones.atencionmedica.edit.windowevaluacion', {
                title: isNew ? 'Añadir Evaluación en Atención Médica' : 'Editar Evaluación en Atención Médica'
            });
        }
        // show window
        win.show();

        // load form with data
        win.down('form').loadRecord(record);
        win.doComponentLayout();
    }
});