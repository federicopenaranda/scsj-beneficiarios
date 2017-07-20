Ext.define('sisscsj.controller.resultadoevaluacion.ResultadoEvaluacion', {
    extend: 'sisscsj.controller.Base',
    stores: [
        'resultadoevaluacion.ResultadoEvaluacion'
    ],
    views: [
        'resultado.Lista',
        'resultadoevaluacion.Lista',
        'resultadoevaluacion.edit.Form',
        'resultadoevaluacion.edit.Window'
    ],
    refs: [
        {
            ref: 'ResultadoEvaluacionLista',
            selector: '[xtype=resultadoevaluacion.lista]'
        },
        {
            ref: 'ResultadoEvaluacionWindow',
            selector: '[xtype=resultadoevaluacion.edit.window]'
        },
        {
            ref: 'ResultadoEvaluacionWindow2',
            selector: '[xtype=resultadoevaluacion.edit.resultadowindow]'
        },
        {
            ref: 'ResultadoEvaluacionForm',
            selector: '[xtype=resultadoevaluacion.edit.form]'
        },
        {
            ref: 'ResultadoLista',
            selector: '[xtype=resultado.lista]'
        }
    ],
    init: function() {
        this.listen({
            controller: {},
            component: {
                'grid[xtype=resultado.lista] button#resultadoevaluacion': {
                    click: this.showEditWindow
                },
                'grid[xtype=resultadoevaluacion.lista]': {
                    beforerender: this.loadRecords,
                    itemdblclick: this.edit,
                    selectionchange: this.manejaBotones,
                    afterrender: this.manejaBotones
                },
                'grid[xtype=resultadoevaluacion.lista] button#add': {
                    click: this.add
                },
                'grid[xtype=resultadoevaluacion.lista] button#edit': {
                    click: this.edit
                },
                'grid[xtype=resultadoevaluacion.lista] button#delete': {
                    click: this.delete2
                },
                'window[xtype=resultadoevaluacion.edit.resultadoevaluacionwindow] button#save': {
                    click: this.save
                },
                'window[xtype=resultadoevaluacion.edit.resultadoevaluacionwindow] button#cancel': {
                    click: this.close
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
        
        var grid2 = me.getResultadoLista();
        var record = grid2.getSelectionModel().getSelection()[0];
        var data = record.getData();
        
        store.filter( "fk_id_resultado", data['id_resultado'] );
    },


    edit: function(view, record, item, index, e, eOpts) {
        var me = this;

        var grid = me.getResultadoEvaluacionLista();
        var record = grid.getSelectionModel().getSelection()[0];
        
        // show window
        me.showEditWindowResultadoEvaluacion(record);
    },


    add: function(button, e, eOpts) {
        var me = this,
                record = Ext.create('sisscsj.model.resultadoevaluacion.ResultadoEvaluacion');

        // show window
        me.showEditWindowResultadoEvaluacion(record);
    },


    manejaBotones: function ( record, index, eOpts ){
        var me = this;
        var grid = me.getResultadoLista();
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
                grid = me.getResultadoEvaluacionLista(),
                store = grid.getStore(),
                win = button.up('window'),
                form = win.down('form'),
                record = form.getRecord(),
                values = form.getValues(),
                callbacks;

        var gridResultado = me.getResultadoLista();
        var recordResultado = gridResultado.getSelectionModel().getSelection()[0];
        var dataResultado = recordResultado.getData();

        values['fk_id_resultado'] = dataResultado['id_resultado'];
        
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
        Ext.getBody().mask('Guardando Evaluaci&oacute;n de Resultado ...');
        
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


    close: function(button, e, eOpts) {
        var me = this,
                win = button.up('window');
        // close the window
        win.close();
    },


    delete2: function() {
        var me = this;

        var grid = me.getResultadoEvaluacionLista();
        var store = grid.getStore();
        var record = grid.getSelectionModel().getSelection()[0];
        
        // show confirmation before continuing
        Ext.Msg.confirm('Atención', '¿Esta seguro que desea eliminar esta Evaluación de Resultado?. Esta acción no puede ser deshecha.', function(buttonId, text, opt) {
            if (buttonId === 'yes') {
                store.remove(record);
                store.sync({
                    failure: function(records, operation) {
                        store.rejectChanges();
                    }
                });
            }
        });
    },


    showEditWindow: function(record) {
        var me = this,
                win = me.getResultadoEvaluacionWindow();
        
        // if window exists, show it; otherwise, create new instance
        if (!win) {
            win = Ext.widget('resultadoevaluacion.edit.window', {
                title: 'Evaluaciones'
            });
        }
        // show window
        win.show();
        win.doComponentLayout();
    },
    
    
    showEditWindowResultadoEvaluacion: function(record) {
        var me = this,
                win = me.getResultadoEvaluacionWindow2(),
                isNew = record.phantom;
        // if window exists, show it; otherwise, create new instance
        if (!win) {
            win = Ext.widget('resultadoevaluacion.edit.resultadoevaluacionwindow', {
                title: isNew ? 'Añadir Evaluaci&oacute;n a Resultado' : 'Editar Evaluaci&oacute;n a Resultado'
            });
        }
        // show window
        win.show();

        // load form with data
        win.down('form').loadRecord(record);
        win.doComponentLayout();
    }
});