Ext.define('sisscsj.controller.marcologico.MarcoLogico', {
    extend: 'sisscsj.controller.Base',
    stores: [
        'marcologico.MarcoLogico'
    ],
    views: [
        'entidad.Lista',
        'marcologico.Lista',
        'marcologico.edit.Form',
        'marcologico.edit.Window'
    ],
    refs: [
        {
            ref: 'MarcoLogicoLista',
            selector: '[xtype=marcologico.lista]'
        },
        {
            ref: 'MarcoLogicoWindow',
            selector: '[xtype=marcologico.edit.window]'
        },
        {
            ref: 'MarcoLogicoWindow2',
            selector: '[xtype=marcologico.edit.marcologicowindow]'
        },
        {
            ref: 'MarcoLogicoForm',
            selector: '[xtype=marcologico.edit.form]'
        },
        {
            ref: 'EntidadLista',
            selector: '[xtype=entidad.lista]'
        }
    ],
    init: function() {
        this.listen({
            controller: {},
            component: {
                'grid[xtype=entidad.lista] button#marcologico': {
                    click: this.showEditWindow
                },
                'grid[xtype=marcologico.lista]': {
                    beforerender: this.loadRecords,
                    itemdblclick: this.edit,
                    selectionchange: this.manejaBotones,
                    afterrender: this.manejaBotones
                },
                'grid[xtype=marcologico.lista] button#add': {
                    click: this.add
                },
                'grid[xtype=marcologico.lista] button#edit': {
                    click: this.edit
                },
                'grid[xtype=marcologico.lista] button#delete': {
                    click: this.delete1
                },
                'window[xtype=marcologico.edit.marcologicowindow] button#save': {
                    click: this.save
                },
                'window[xtype=marcologico.edit.marcologicowindow] button#cancel': {
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
        
        var grid2 = me.getEntidadLista();
        var record = grid2.getSelectionModel().getSelection()[0];
        var data = record.getData();
        
        store.filter( "fk_id_entidad", data['id_entidad'] );
        
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

        var grid = me.getMarcoLogicoLista();
        var record = grid.getSelectionModel().getSelection()[0];
        
        // show window
        me.showEditWindowMarcoLogico(record);
    },


    add: function(button, e, eOpts) {
        var me = this,
                record = Ext.create('sisscsj.model.marcologico.MarcoLogico');

        // show window
        me.showEditWindowMarcoLogico(record);
    },


    manejaBotones: function ( record, index, eOpts ){
        var me = this;
        var grid = me.getMarcoLogicoLista();
        var records = grid.getSelectionModel().getSelection();

        var botonEdit = grid.down("[xtype='toolbar'] button#edit");
        var botonDelete = grid.down("[xtype='toolbar'] button#delete");
        var botonObjetivoGeneral = grid.down("[xtype='toolbar'] button#objetivo_general");

        if (records.length > 0)
        {
            botonEdit.enable();
            botonDelete.enable();
            botonObjetivoGeneral.enable();
        }
        else
        {
            botonEdit.disable();
            botonDelete.disable();
            botonObjetivoGeneral.disable();
        }
    },


    save: function(button, e, eOpts) {
        var me = this,
                grid = me.getMarcoLogicoLista(),
                store = grid.getStore(),
                win = button.up('window'),
                form = win.down('form'),
                record = form.getRecord(),
                values = form.getValues(),
                callbacks;

        var gridEntidad = me.getEntidadLista();
        var recordEntidad = gridEntidad.getSelectionModel().getSelection()[0];
        var dataEntidad = recordEntidad.getData();

        values['fk_id_entidad'] = dataEntidad['id_entidad'];
        
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
        Ext.getBody().mask('Guardando Marco Lógico ...');
        
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


    delete1: function() {
        var me = this;

        var grid = me.getMarcoLogicoLista();
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
                win = me.getMarcoLogicoWindow();
        
        // if window exists, show it; otherwise, create new instance
        if (!win) {
            win = Ext.widget('marcologico.edit.window', {
                title: 'Marcos Lógicos'
            });
        }
        // show window
        win.show();
        win.doComponentLayout();
    },
    
    
    showEditWindowMarcoLogico: function(record) {
        var me = this,
                win = me.getMarcoLogicoWindow2(),
                isNew = record.phantom;
        // if window exists, show it; otherwise, create new instance
        if (!win) {
            win = Ext.widget('marcologico.edit.marcologicowindow', {
                title: isNew ? 'Añadir Marco Lógico' : 'Editar Marco Lógico'
            });
        }
        // show window
        win.show();

        // load form with data
        win.down('form').loadRecord(record);
        win.doComponentLayout();
    }
});