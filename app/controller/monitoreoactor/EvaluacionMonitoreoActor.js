Ext.define('sisscsj.controller.monitoreoactor.EvaluacionMonitoreoActor', {
    extend: 'sisscsj.controller.Base',
    modelo: null,
    store2: null,
    stores: [
        'monitoreoactor.EvaluacionMonitoreoActor'
    ],
    views: [
        'monitoreoactor.MonitoreoActor.Lista',
        'monitoreoactor.EvaluacionMonitoreoActor.Lista',
        'monitoreoactor.EvaluacionMonitoreoActor.edit.Form',
        'monitoreoactor.EvaluacionMonitoreoActor.edit.Window'
    ],
    refs: [
        {
            ref: 'MonitoreoActorLista',
            selector: '[xtype=monitoreoactor.monitoreoactor.lista]'
        },
        {
            ref: 'EvaluacionMonitoreoActorLista',
            selector: '[xtype=monitoreoactor.evaluacionmonitoreoactor.lista]'
        },
        {
            ref: 'EvaluacionMonitoreoActorWindow',
            selector: '[xtype=monitoreoactor.evaluacionmonitoreoactor.edit.window]'
        },
        {
            ref: 'EvaluacionMonitoreoActorForm',
            selector: '[xtype=monitoreoactor.evaluacionmonitoreoactor.edit.form]'
        }
    ],
    init: function() {
        this.listen({
            controller: {},
            component: {
                'grid[xtype=monitoreoactor.monitoreoactor.lista]': {

                },
                'grid[xtype=monitoreoactor.evaluacionmonitoreoactor.lista]': {
                    beforerender: this.loadRecords,
                    //itemdblclick: this.edit,
                    selectionchange: this.manejaBotones,
                    afterrender: this.manejaBotones
                },
                'grid[xtype=monitoreoactor.evaluacionmonitoreoactor.lista] button#add': {
                    click: this.add
                },
                'grid[xtype=monitoreoactor.evaluacionmonitoreoactor.lista] button#edit': {
                    click: this.edit
                },
                'grid[xtype=monitoreoactor.evaluacionmonitoreoactor.lista] button#delete': {
                    click: this.remove
                },
                'window[xtype=monitoreoactor.evaluacionmonitoreoactor.edit.window] button#save': {
                    click: this.save
                },
                'window[xtype=monitoreoactor.evaluacionmonitoreoactor.edit.window] button#cancel': {
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
        var grid = me.getEvaluacionMonitoreoActorLista();
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
        var me = this;
        var store = grid.getStore();
        
        
        Ext.data.JsonP.request({
            url: sisscsj.app.globals.globalServerPath + 'EvaluacionMonitoreoActor/especial',
            params: {
                id_tipo_monitoreo_actor: 1
            },
            success: function( response, options ) {
                if (response.success) 
                {
                    store.model.setFields(response.metaData.fields);
                    grid.reconfigure(store, response.metaData.columns);
                    
                    //store.loadRawData(response.data, false);
                    Ext.define('mod1', {
                        extend: 'Ext.data.Model',
                        fields: response.metaData.fields
                    });
                    me.modelo = mod1.create();
                    me.store2 = store;
                }
                
                // clear any fliters that have been applied
                store.clearFilter(true);
                var contMonitoreoActor = me.getController('monitoreoactor.MonitoreoActor');

                // Si se esta editando un monitoreo filtrar los evaluacions por su ID
                if ( contMonitoreoActor.boolMonitoreoActorEdit === 1)
                {
                    var grid2 = me.getMonitoreoActorLista();
                    var dd = grid2.getSelectionModel().getSelection();

                    if ( dd.length === 1 )
                    {
                        var record = dd[0];
                        var data = record.getData();

                        store.filter( 'fk_id_monitoreo_actor', data['id_monitoreo_actor'] );
                    }
                }
                /*else
                {
                    store.filter( 'estado_criterio_monitoreo_actor', 1 );
                }*/
            },
            failure: function( response, options ) {
                Ext.Msg.alert( 'Atención', 'Un error ocurrió al ingresar. Por favor intenta nuevamente.' );
            }
        });
    },


    edit: function(view, record, item, index, e, eOpts) {
        var me = this;
        var grid = me.getEvaluacionMonitoreoActorLista();
        var record = grid.getSelectionModel().getSelection()[0];
        
        me.showEditWindow(record);
    },


    add: function(button, e, eOpts) {
        var me = this,
                record = Ext.create('mod1');

        me.store2.add(record);

        // show window
        //me.showEditWindow(record);
    },


    save: function(button, e, eOpts) {
        var me = this,
                grid = me.getEvaluacionMonitoreoActorLista(),
                store = grid.getStore(),
                win = button.up('window'),
                form = win.down('form'),
                record = form.getRecord(),
                values = form.getValues();

        // set values of record from form
        record.set(values);

        // check if form is even dirty...if not, just close window and stop everything...nothing to see here
        if (!record.dirty) {
            win.close();
            return;
        }

        if ( form.isValid() )
        {
            // si es nuevo registro se lo añade al store, sino se lo actualiza
            var rowIndex = store.indexOf(record);
            ( rowIndex === -1 ) ? store.add(record) : form.updateRecord(record);

            win.close();
        }
        else
        {
            Ext.Msg.alert('Error de Validación', 'Por favor revise los datos del formulario.');
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
            msg: '¿Esta seguro que desea eliminar esta Evaluación?. Esta acción no puede ser deshecha.',
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
            win = Ext.widget('monitoreoactor.evaluacionmonitoreoactor.edit.window', {
                //title: isNew ? 'Añadir Evaluacion' : 'Editar Evaluacion'
                title: 'Editar Evaluacion'
            });
        }

        win.show();
        win.down('form').loadRecord(record);
        win.doComponentLayout();
    },


    sincronizar: function() {
        var me = this,
            grid = me.getEvaluacionMonitoreoActorLista(),
            store = grid.getStore();

        store.sync();
    }
});