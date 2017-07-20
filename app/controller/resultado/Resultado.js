Ext.define('sisscsj.controller.resultado.Resultado', {
    extend: 'sisscsj.controller.Base',
    stores: [
        'resultado.Resultado'
    ],
    views: [
        'objetivoespecifico.Lista',
        'resultado.Lista',
        'resultado.edit.Form',
        'resultado.edit.Window'
    ],
    refs: [
        {
            ref: 'ResultadoLista',
            selector: '[xtype=resultado.lista]'
        },
        {
            ref: 'ResultadoWindow',
            selector: '[xtype=resultado.edit.window]'
        },
        {
            ref: 'ResultadoWindow2',
            selector: '[xtype=resultado.edit.resultadowindow]'
        },
        {
            ref: 'ResultadoForm',
            selector: '[xtype=resultado.edit.form]'
        },
        {
            ref: 'ObjetivoEspecificoLista',
            selector: '[xtype=objetivoespecifico.lista]'
        }
    ],
    init: function() {
        this.listen({
            controller: {},
            component: {
                'grid[xtype=objetivoespecifico.lista] button#resultado': {
                    click: this.showEditWindow
                },
                'grid[xtype=resultado.lista]': {
                    beforerender: this.loadRecords,
                    itemdblclick: this.edit,
                    selectionchange: this.manejaBotones,
                    afterrender: this.manejaBotones
                },
                'grid[xtype=resultado.lista] button#add': {
                    click: this.add
                },
                'grid[xtype=resultado.lista] button#edit': {
                    click: this.edit
                },
                'grid[xtype=resultado.lista] button#delete': {
                    click: this.delete2
                },
                'window[xtype=resultado.edit.resultadowindow] button#save': {
                    click: this.save
                },
                'window[xtype=resultado.edit.resultadowindow] button#cancel': {
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
        
        var grid2 = me.getObjetivoEspecificoLista();
        var record = grid2.getSelectionModel().getSelection()[0];
        var data = record.getData();
        
        store.filter( "fk_id_objetivo_especifico", data['id_objetivo_especifico'] );
    },


    edit: function(view, record, item, index, e, eOpts) {
        var me = this;

        var grid = me.getResultadoLista();
        var record = grid.getSelectionModel().getSelection()[0];
        
        // show window
        me.showEditWindowResultado(record);
    },


    add: function(button, e, eOpts) {
        var me = this,
                record = Ext.create('sisscsj.model.resultado.Resultado');

        // show window
        me.showEditWindowResultado(record);
    },


    manejaBotones: function ( record, index, eOpts ){
        var me = this;
        var grid = me.getResultadoLista();
        var records = grid.getSelectionModel().getSelection();

        var botonEdit = grid.down("[xtype='toolbar'] button#edit");
        var botonDelete = grid.down("[xtype='toolbar'] button#delete");
        var botonEvaluacion = grid.down("[xtype='toolbar'] button#resultadoevaluacion");
        

        if (records.length > 0)
        {
            botonEdit.enable();
            botonDelete.enable();
            botonEvaluacion.enable();
        }
        else
        {
            botonEdit.disable();
            botonDelete.disable();
            botonEvaluacion.disable();
        }
    },


    save: function(button, e, eOpts) {
        var me = this,
                grid = me.getResultadoLista(),
                store = grid.getStore(),
                win = button.up('window'),
                form = win.down('form'),
                record = form.getRecord(),
                values = form.getValues(),
                callbacks;

        var gridObjetivoEspecifico = me.getObjetivoEspecificoLista();
        var recordObjetivoEspecifico = gridObjetivoEspecifico.getSelectionModel().getSelection()[0];
        var dataObjetivoEspecifico = recordObjetivoEspecifico.getData();

        values['fk_id_objetivo_especifico'] = dataObjetivoEspecifico['id_objetivo_especifico'];
        
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
        Ext.getBody().mask('Guardando Resultado ...');
        
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

        var grid = me.getResultadoLista();
        var store = grid.getStore();
        var record = grid.getSelectionModel().getSelection()[0];
        
        // show confirmation before continuing
        Ext.Msg.confirm('Atención', '¿Esta seguro que desea eliminar este Resultado?. Esta acción no puede ser deshecha.', function(buttonId, text, opt) {
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
                win = me.getResultadoWindow();
        
        // if window exists, show it; otherwise, create new instance
        if (!win) {
            win = Ext.widget('resultado.edit.window', {
                title: 'Resultados'
            });
        }
        // show window
        win.show();
        win.doComponentLayout();
    },
    
    
    showEditWindowResultado: function(record) {
        var me = this,
                win = me.getResultadoWindow2(),
                isNew = record.phantom;
        // if window exists, show it; otherwise, create new instance
        if (!win) {
            win = Ext.widget('resultado.edit.resultadowindow', {
                title: isNew ? 'Añadir Resultado' : 'Editar Resultado'
            });
        }
        // show window
        win.show();

        // load form with data
        win.down('form').loadRecord(record);
        win.doComponentLayout();
    }
});