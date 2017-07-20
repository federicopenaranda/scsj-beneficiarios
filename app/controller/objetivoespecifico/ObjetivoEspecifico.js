Ext.define('sisscsj.controller.objetivoespecifico.ObjetivoEspecifico', {
    extend: 'sisscsj.controller.Base',
    stores: [
        'objetivoespecifico.ObjetivoEspecifico'
    ],
    views: [
        'objetivogeneral.Lista',
        'objetivoespecifico.Lista',
        'objetivoespecifico.edit.Form',
        'objetivoespecifico.edit.Window'
    ],
    refs: [
        {
            ref: 'ObjetivoEspecificoLista',
            selector: '[xtype=objetivoespecifico.lista]'
        },
        {
            ref: 'ObjetivoEspecificoWindow',
            selector: '[xtype=objetivoespecifico.edit.window]'
        },
        {
            ref: 'ObjetivoEspecificoWindow2',
            selector: '[xtype=objetivoespecifico.edit.objetivoespecificowindow]'
        },
        {
            ref: 'ObjetivoEspecificoForm',
            selector: '[xtype=objetivoespecifico.edit.form]'
        },
        {
            ref: 'ObjetivoGeneralLista',
            selector: '[xtype=objetivogeneral.lista]'
        }
    ],
    init: function() {
        this.listen({
            controller: {},
            component: {
                'grid[xtype=objetivogeneral.lista] button#objetivoespecifico': {
                    click: this.showEditWindow
                },
                'grid[xtype=objetivoespecifico.lista]': {
                    beforerender: this.loadRecords,
                    itemdblclick: this.edit,
                    selectionchange: this.manejaBotones,
                    afterrender: this.manejaBotones
                },
                'grid[xtype=objetivoespecifico.lista] button#add': {
                    click: this.add
                },
                'grid[xtype=objetivoespecifico.lista] button#edit': {
                    click: this.edit
                },
                'grid[xtype=objetivoespecifico.lista] button#delete': {
                    click: this.delete2
                },
                'window[xtype=objetivoespecifico.edit.objetivoespecificowindow] button#save': {
                    click: this.save
                },
                'window[xtype=objetivoespecifico.edit.objetivoespecificowindow] button#cancel': {
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
        
        var grid2 = me.getObjetivoGeneralLista();
        var record = grid2.getSelectionModel().getSelection()[0];
        var data = record.getData();
        
        store.filter( "fk_id_objetivo_general", data['id_objetivo_general'] );
        
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

        var grid = me.getObjetivoEspecificoLista();
        var record = grid.getSelectionModel().getSelection()[0];
        
        // show window
        me.showEditWindowObjetivoEspecifico(record);
    },


    add: function(button, e, eOpts) {
        var me = this,
                record = Ext.create('sisscsj.model.objetivoespecifico.ObjetivoEspecifico');

        // show window
        me.showEditWindowObjetivoEspecifico(record);
    },


    manejaBotones: function ( record, index, eOpts ){
        var me = this;
        var grid = me.getObjetivoEspecificoLista();
        var records = grid.getSelectionModel().getSelection();

        var botonEdit = grid.down("[xtype='toolbar'] button#edit");
        var botonDelete = grid.down("[xtype='toolbar'] button#delete");
        var botonResultado = grid.down("[xtype='toolbar'] button#resultado");
        

        if (records.length > 0)
        {
            botonEdit.enable();
            botonDelete.enable();
            botonResultado.enable();
        }
        else
        {
            botonEdit.disable();
            botonDelete.disable();
            botonResultado.disable();
        }
    },


    save: function(button, e, eOpts) {
        var me = this,
                grid = me.getObjetivoEspecificoLista(),
                store = grid.getStore(),
                win = button.up('window'),
                form = win.down('form'),
                record = form.getRecord(),
                values = form.getValues(),
                callbacks;

        var gridObjetivoGeneral = me.getObjetivoGeneralLista();
        var recordObjetivoGeneral = gridObjetivoGeneral.getSelectionModel().getSelection()[0];
        var dataObjetivoGeneral = recordObjetivoGeneral.getData();

        values['fk_id_objetivo_general'] = dataObjetivoGeneral['id_objetivo_general'];
        
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
        Ext.getBody().mask('Guardando Objetivo Específico ...');
        
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

        var grid = me.getObjetivoEspecificoLista();
        var store = grid.getStore();
        var record = grid.getSelectionModel().getSelection()[0];
        
        // show confirmation before continuing
        Ext.Msg.confirm('Atención', '¿Esta seguro que desea eliminar este Objetivo Específico?. Esta acción no puede ser deshecha.', function(buttonId, text, opt) {
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
                win = me.getObjetivoEspecificoWindow();
        
        // if window exists, show it; otherwise, create new instance
        if (!win) {
            win = Ext.widget('objetivoespecifico.edit.window', {
                title: 'Objetivos Específicos'
            });
        }
        // show window
        win.show();
        win.doComponentLayout();
    },
    
    
    showEditWindowObjetivoEspecifico: function(record) {
        var me = this,
                win = me.getObjetivoEspecificoWindow2(),
                isNew = record.phantom;
        // if window exists, show it; otherwise, create new instance
        if (!win) {
            win = Ext.widget('objetivoespecifico.edit.objetivoespecificowindow', {
                title: isNew ? 'Añadir Objetivo Específico' : 'Editar Objetivo Específico'
            });
        }
        // show window
        win.show();

        // load form with data
        win.down('form').loadRecord(record);
        win.doComponentLayout();
    }
});