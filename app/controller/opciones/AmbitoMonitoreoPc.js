Ext.define('sisscsj.controller.opciones.AmbitoMonitoreoPc', {
    extend: 'sisscsj.controller.Base',
    stores: [
        'opciones.AmbitoMonitoreoPc'
    ],
    views: [
        'opciones.AmbitoMonitoreoPc.Lista',
        'opciones.AmbitoMonitoreoPc.edit.Form',
        'opciones.AmbitoMonitoreoPc.edit.Window'
    ],
    refs: [
        {
            ref: 'AmbitoMonitoreoPcLista',
            selector: '[xtype=opciones.ambitomonitoreopc.lista]'
        },
        {
            ref: 'AmbitoMonitoreoPcWindow',
            selector: '[xtype=opciones.ambitomonitoreopc.edit.window]'
        },
        {
            ref: 'AmbitoMonitoreoPcForm',
            selector: '[xtype=opciones.ambitomonitoreopc.edit.form]'
        }
    ],
    init: function() {
        this.listen({
            controller: {},
            component: {
                'grid[xtype=opciones.ambitomonitoreopc.lista]': {
                    beforerender: this.loadRecords,
                    itemdblclick: this.edit,
                    selectionchange: this.manejaBotones,
                    afterrender: this.manejaBotones
                },
                'grid[xtype=opciones.ambitomonitoreopc.lista] button#add': {
                    click: this.add
                },
                'grid[xtype=opciones.ambitomonitoreopc.lista] button#edit': {
                    click: this.edit
                },
                'grid[xtype=opciones.ambitomonitoreopc.lista] button#delete': {
                    click: this.remove
                },
                'window[xtype=opciones.ambitomonitoreopc.edit.window] button#save': {
                    click: this.save
                },
                'window[xtype=opciones.ambitomonitoreopc.edit.window] button#cancel': {
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
        var grid = me.getAmbitoMonitoreoPcLista();
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
        var grid = me.getAmbitoMonitoreoPcLista();
        var record = grid.getSelectionModel().getSelection()[0];
        me.showEditWindow(record);
    },


    add: function(button, e, eOpts) {
        var me = this,
                record = Ext.create('sisscsj.model.opciones.AmbitoMonitoreoPc');
        // show window
        me.showEditWindow(record);
    },


    save: function(button, e, eOpts) {
        var me = this,
                grid = me.getAmbitoMonitoreoPcLista(),
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
        Ext.getBody().mask('Guardando Ámbito de Monitoreo ...');
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


    remove: function() {
        var me = this;

        var grid = me.getAmbitoMonitoreoPcLista();
        var store = grid.getStore();
        var record = grid.getSelectionModel().getSelection()[0];
        
        // show confirmation before continuing
        Ext.Msg.confirm({
            title: 'Atención',
            msg: '¿Esta seguro que desea eliminar este Ámbito de Monitoreo?. Esta acción no puede ser deshecha.',
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
                win = me.getAmbitoMonitoreoPcWindow(),
                isNew = record.phantom;

        if (!win) {
            win = Ext.widget('opciones.ambitomonitoreopc.edit.window', {
                title: isNew ? 'Añadir Ámbito de Monitoreo' : 'Editar Ámbito de Monitoreo'
            });
        }

        win.show();
        win.down('form').loadRecord(record);
        win.doComponentLayout();
    }
});