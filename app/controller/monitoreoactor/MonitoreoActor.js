Ext.define('sisscsj.controller.monitoreoactor.MonitoreoActor', {
    extend: 'sisscsj.controller.Base',
    boolMonitoreoActorEdit: 0,
    stores: [
        'monitoreoactor.MonitoreoActor'
    ],
    views: [
        'monitoreoactor.MonitoreoActor.Lista',
        'monitoreoactor.MonitoreoActor.edit.Form',
        'monitoreoactor.MonitoreoActor.edit.Window'
    ],
    refs: [
        {
            ref: 'MonitoreoActorLista',
            selector: '[xtype=monitoreoactor.monitoreoactor.lista]'
        },
        {
            ref: 'MonitoreoActorWindow',
            selector: '[xtype=monitoreoactor.monitoreoactor.edit.window]'
        },
        {
            ref: 'MonitoreoActorForm',
            selector: '[xtype=monitoreoactor.monitoreoactor.edit.form]'
        },
        {
            ref: 'EvaluacionMonitoreoActorLista',
            selector: '[xtype=monitoreoactor.evaluacionmonitoreoactor.lista]'
        }
    ],
    init: function() {
        this.listen({
            controller: {},
            component: {
                'grid[xtype=monitoreoactor.monitoreoactor.lista]': {
                    beforerender: this.loadRecords,
                    itemdblclick: this.edit,
                    selectionchange: this.manejaBotones,
                    afterrender: this.manejaBotones
                },
                'grid[xtype=monitoreoactor.monitoreoactor.lista] menuitem#add_monitoreo_actor_nino': {
                    click: this.addNino
                },
                'grid[xtype=monitoreoactor.monitoreoactor.lista] button#edit': {
                    click: this.edit
                },
                'grid[xtype=monitoreoactor.monitoreoactor.lista] button#delete': {
                    click: this.remove
                },
                'window[xtype=monitoreoactor.monitoreoactor.edit.window] button#save': {
                    click: this.save
                },
                'window[xtype=monitoreoactor.monitoreoactor.edit.window] button#cancel': {
                    click: this.close
                }
            },
            global: {},
            store: {},
            proxy: {}
        });
    },


    manejaBotones: function ( record, index, eOpts ){
        var me = this;
        var grid = me.getMonitoreoActorLista();
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


    loadRecords: function(grid, eOpts) {
        var store = grid.getStore();
        store.clearFilter(true);
        store.load();
    },


    edit: function(view, record, item, index, e, eOpts) {
        var me = this;
        var grid = me.getMonitoreoActorLista();
        var record = grid.getSelectionModel().getSelection()[0];
                
        me.boolMonitoreoPcEdit = 1;
        
        me.showEditWindow(record);
    },


    addNino: function(button, e, eOpts) {
        var me = this,
                record = Ext.create('sisscsj.model.monitoreoactor.MonitoreoActor');
        
        record.set('fk_id_tipo_monitoreo_actor', 1);

        me.boolMonitoreoPcEdit = 0;
        
        // show window
        me.showEditWindow(record);
    },


    save: function(button, e, eOpts) {
        var me = this,
                grid = me.getMonitoreoActorLista(),
                store = grid.getStore(),
                win = button.up('window'),
                form = win.down('form'),
                record = form.getRecord(),
                values = form.getValues(),
                callbacks;  
        
        values['fk_id_usuario'] = null;

        if ( !form.isValid() )
        {
            Ext.Msg.alert('Error de Validación', 'Por favor revise los datos del formulario.');
            return;
        }

        if ( me.boolMonitoreoActorEdit === 0 )
        {
            ////////////////////////////////////////////
            // [INICIO] Procesamiento de grid Evaluacion
            ////////////////////////////////////////////
            var evaluacion = me.getEvaluacionMonitoreoActorLista(); // your grid
            var evaluacion_store = evaluacion.getStore();     // your grid's store    
            var evaluacion_selected = evaluacion_store.getRange();  // getRange = select all records
            
            var arrayEvaluacion = []; // start with empty array

            Ext.each(evaluacion_selected, function(item) {
                var rec = item.getData();
                arrayEvaluacion.push(rec); // push this to the array
            }, this);

            var objEvaluaciones = Ext.encode(arrayEvaluacion);

            values['evaluacion_monitoreo_actor'] = objEvaluaciones;
            ////////////////////////////////////////////
            // [FIN] Procesamiento de grid Evaluacion
            ////////////////////////////////////////////
        }
        else
        {
            me.getController('monitoreoactor.EvaluacionMonitoreoActor').sincronizar();
        }

        // set values of record from form
        values['fk_id_usuario'] = null;        
        record.set(values);
        
        // check if form is even dirty...if not, just close window and stop everything...nothing to see here
        if (record.dirty) {
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
            Ext.getBody().mask('Guardando Monitoreo de Actor ...');
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
        else
        {
            win.close();
            return;
        }
    },


    close: function(button, e, eOpts) {
        var me = this,
                win = button.up('window');
        // close the window
        win.close();
    },


    remove: function() {
        var me = this;

        var grid = me.getMonitoreoActorLista();
        var store = grid.getStore();
        var record = grid.getSelectionModel().getSelection()[0];
        
        // show confirmation before continuing
        Ext.Msg.confirm({
            title: 'Atención',
            msg: '¿Esta seguro que desea eliminar este Monitoreo?. Esta acción no puede ser deshecha.',
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
                }
            }
        });
    },


    showEditWindow: function(record) {
        var me = this,
                win = me.getMonitoreoActorWindow(),
                isNew = record.phantom;

        if (!win) {
            win = Ext.widget('monitoreoactor.monitoreoactor.edit.window', {
                title: isNew ? 'Añadir Monitoreo de Actor' : 'Editar Monitoreo de Actor'
            });
        }

        win.show();
        win.down('form').loadRecord(record);
        win.doComponentLayout();
    }
});