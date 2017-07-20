Ext.define('sisscsj.controller.objetivogeneral.ObjetivoGeneral', {
    extend: 'sisscsj.controller.Base',
    stores: [
        'objetivogeneral.ObjetivoGeneral'
    ],
    views: [
        'marcologico.Lista',
        'objetivogeneral.Lista',
        'objetivogeneral.edit.Form',
        'objetivogeneral.edit.Window'
    ],
    refs: [
        {
            ref: 'ObjetivoGeneralLista',
            selector: '[xtype=objetivogeneral.lista]'
        },
        {
            ref: 'ObjetivoGeneralWindow',
            selector: '[xtype=objetivogeneral.edit.window]'
        },
        {
            ref: 'ObjetivoGeneralWindow2',
            selector: '[xtype=objetivogeneral.edit.objetivogeneralwindow]'
        },
        {
            ref: 'ObjetivoGeneralForm',
            selector: '[xtype=objetivogeneral.edit.form]'
        },
        {
            ref: 'MarcoLogicoLista',
            selector: '[xtype=marcologico.lista]'
        }
    ],
    init: function() {
        this.listen({
            controller: {},
            component: {
                'grid[xtype=marcologico.lista] button#objetivo_general': {
                    click: this.showEditWindow
                },
                'grid[xtype=objetivogeneral.lista]': {
                    beforerender: this.loadRecords,
                    itemdblclick: this.edit,
                    selectionchange: this.manejaBotones,
                    afterrender: this.manejaBotones
                },
                'grid[xtype=objetivogeneral.lista] button#add': {
                    click: this.add
                },
                'grid[xtype=objetivogeneral.lista] button#edit': {
                    click: this.edit
                },
                'grid[xtype=objetivogeneral.lista] button#delete': {
                    click: this.delete2
                },
                'window[xtype=objetivogeneral.edit.objetivogeneralwindow] button#save': {
                    click: this.save
                },
                'window[xtype=objetivogeneral.edit.objetivogeneralwindow] button#cancel': {
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
        
        var grid2 = me.getMarcoLogicoLista();
        var record = grid2.getSelectionModel().getSelection()[0];
        var data = record.getData();
        
        store.filter( "fk_id_marco_logico", data['id_marco_logico'] );
        
        // load the store
        /*var grid2 = me.getBeneficiarioLista();
        var record = grid2.getSelectionModel().getSelection()[0];
        var data = record.getData();
        
        store.getProxy().extraParams = {
            fk_id_beneficiario: data['id_beneficiario']
        };*/

        //store.load();
    },


    edit: function(view, record, item, index, e, eOpts) {
        var me = this;

        var grid = me.getObjetivoGeneralLista();
        var record = grid.getSelectionModel().getSelection()[0];
        
        // show window
        me.showEditWindowObjetivoGeneral(record);
    },


    add: function(button, e, eOpts) {
        var me = this,
                record = Ext.create('sisscsj.model.objetivogeneral.ObjetivoGeneral');

        // show window
        me.showEditWindowObjetivoGeneral(record);
    },


    manejaBotones: function ( record, index, eOpts ){
        var me = this;
        var grid = me.getObjetivoGeneralLista();
        var records = grid.getSelectionModel().getSelection();

        var botonEdit = grid.down("[xtype='toolbar'] button#edit");
        var botonDelete = grid.down("[xtype='toolbar'] button#delete");
        var botonObjEsp = grid.down("[xtype='toolbar'] button#objetivoespecifico");

        if (records.length > 0)
        {
            botonEdit.enable();
            botonDelete.enable();
            botonObjEsp.enable();
        }
        else
        {
            botonEdit.disable();
            botonDelete.disable();
            botonObjEsp.disable();
        }
    },


    save: function(button, e, eOpts) {
        var me = this,
                grid = me.getObjetivoGeneralLista(),
                store = grid.getStore(),
                win = button.up('window'),
                form = win.down('form'),
                record = form.getRecord(),
                values = form.getValues(),
                callbacks;

        var gridMarcoLogico = me.getMarcoLogicoLista();
        var recordMarcoLogico = gridMarcoLogico.getSelectionModel().getSelection()[0];
        var dataMarcoLogico = recordMarcoLogico.getData();

        values['fk_id_marco_logico'] = dataMarcoLogico['id_marco_logico'];
        
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
        Ext.getBody().mask('Guardando Objetivo General ...');
        
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

        var grid = me.getObjetivoGeneralLista();
        var store = grid.getStore();
        var record = grid.getSelectionModel().getSelection()[0];
        
        // show confirmation before continuing
        Ext.Msg.confirm('Atención', '¿Esta seguro que desea eliminar este Objetivo General?. Esta acción no puede ser deshecha.', function(buttonId, text, opt) {
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
                win = me.getObjetivoGeneralWindow();
        
        // if window exists, show it; otherwise, create new instance
        if (!win) {
            win = Ext.widget('objetivogeneral.edit.window', {
                title: 'Objetivos Generales'
            });
        }
        // show window
        win.show();
        win.doComponentLayout();
    },
    
    
    showEditWindowObjetivoGeneral: function(record) {
        var me = this,
                win = me.getObjetivoGeneralWindow2(),
                isNew = record.phantom;
        // if window exists, show it; otherwise, create new instance
        if (!win) {
            win = Ext.widget('objetivogeneral.edit.objetivogeneralwindow', {
                title: isNew ? 'Añadir Objetivo General' : 'Editar Objetivo General'
            });
        }
        // show window
        win.show();

        // load form with data
        win.down('form').loadRecord(record);
        win.doComponentLayout();
    }
});