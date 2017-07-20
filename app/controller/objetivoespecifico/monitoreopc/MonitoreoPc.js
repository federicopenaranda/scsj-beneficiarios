Ext.define('sisscsj.controller.monitoreopc.MonitoreoPc', {
    extend: 'sisscsj.controller.Base',
    boolMonitoreoPcEdit: 0,
    stores: [
        'monitoreopc.MonitoreoPc'
    ],
    views: [
        'monitoreopc.MonitoreoPc.Lista',
        'monitoreopc.MonitoreoPc.edit.Form',
        'monitoreopc.MonitoreoPc.edit.Window'
    ],
    refs: [
        {
            ref: 'MonitoreoPcLista',
            selector: '[xtype=monitoreopc.monitoreopc.lista]'
        },
        {
            ref: 'MonitoreoPcWindow',
            selector: '[xtype=monitoreopc.monitoreopc.edit.window]'
        },
        {
            ref: 'MonitoreoPcForm',
            selector: '[xtype=monitoreopc.monitoreopc.edit.form]'
        },
        {
            ref: 'ResultadoMonitoreoPcLista',
            selector: '[xtype=monitoreopc.resultadomonitoreopc.lista]'
        },
        
        /*
         * Componente para cargar un reporte
         */
        {
            ref: 'FileDownloader',
            selector: '[xtype=FileDownloader]'
        }
    ],
    init: function() {
        this.listen({
            controller: {},
            component: {
                'grid[xtype=monitoreopc.monitoreopc.lista]': {
                    beforerender: this.loadRecords,
                    itemdblclick: this.edit,
                    selectionchange: this.manejaBotones,
                    afterrender: this.manejaBotones
                },
                'grid[xtype=monitoreopc.monitoreopc.lista] button#add': {
                    click: this.add
                },
                'grid[xtype=monitoreopc.monitoreopc.lista] button#edit': {
                    click: this.edit
                },
                'grid[xtype=monitoreopc.monitoreopc.lista] button#delete': {
                    click: this.remove
                },
                'grid[xtype=monitoreopc.monitoreopc.lista] button#reporte_monitoreo_pc': {
                    click: this.reporte1
                },
                'window[xtype=monitoreopc.monitoreopc.edit.window] button#save': {
                    click: this.save
                },
                'window[xtype=monitoreopc.monitoreopc.edit.window] button#cancel': {
                    click: this.close
                }
            },
            global: {},
            store: {},
            proxy: {}
        });
    },
    
    reporte1: function() {
        var me = this,
                fd = me.getFileDownloader();
        var grid = me.getMonitoreoPcLista();
        var selected = grid.getSelectionModel().getSelection();
        
        if (selected.length === 1)
        {
            var data = selected[0].getData();

            fd.load({
                url: sisscsj.app.globals.globalServerPath + 'Reporte/reporte6',
                params: {
                    id_monitoreo_punto_comunitario: data['id_monitoreo_punto_comunitario']
                }
            });
        }
    },


    manejaBotones: function ( record, index, eOpts ){
        var me = this;
        var grid = me.getMonitoreoPcLista();
        var records = grid.getSelectionModel().getSelection();

        var botonEdit = grid.down("[xtype='toolbar'] button#edit");
        var botonDelete = grid.down("[xtype='toolbar'] button#delete");
        var botonReporte = grid.down("[xtype='toolbar'] button#reporte_monitoreo_pc");

        if (records.length > 0)
        {
            botonEdit.enable();
            botonDelete.enable();
            botonReporte.enable();
        }
        else
        {
            botonEdit.disable();
            botonDelete.disable();
            botonReporte.disable();
        }
    },


    loadRecords: function(grid, eOpts) {
        var store = grid.getStore();
        store.clearFilter(true);
        store.load();
    },


    edit: function(view, record, item, index, e, eOpts) {
        var me = this;
        var grid = me.getMonitoreoPcLista();
        var record = grid.getSelectionModel().getSelection()[0];
        
        me.boolMonitoreoPcEdit = 1;
        
        me.showEditWindow(record);
    },


    add: function(button, e, eOpts) {
        var me = this,
                record = Ext.create('sisscsj.model.monitoreopc.MonitoreoPc');
        
        me.boolMonitoreoPcEdit = 0;
        
        // show window
        me.showEditWindow(record);
    },


    save: function(button, e, eOpts) {
        var me = this,
                grid = me.getMonitoreoPcLista(),
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
        
        if ( !me.revisaResultados() )
        {
            Ext.Msg.alert('Error de Validación', 'Por favor revise que haya llenado todos los resultados.');
            return;
        }

        if ( me.boolMonitoreoPcEdit === 0 )
        {
            ////////////////////////////////////////////
            // [INICIO] Procesamiento de grid Resultado
            ////////////////////////////////////////////
            var resultado = me.getResultadoMonitoreoPcLista(); // your grid
            var resultado_store = resultado.getStore();     // your grid's store    
            var resultado_selected = resultado_store.getRange();  // getRange = select all records

            var arrayResultado = []; // start with empty array
            Ext.each(resultado_selected, function(item) {
                // add the fields that you want to include
                var tmpResultados = {
                    resultado_monitoreo_pc: item.get('resultado_monitoreo_pc'),
                    fk_id_ambito_monitoreo_pc: item.get('fk_id_ambito_monitoreo_pc'),
                    fk_id_monitoreo_punto_comunitario: item.get('fk_id_monitoreo_punto_comunitario')
                };
                arrayResultado.push(tmpResultados); // push this to the array
            }, this);

            var objResultados = Ext.encode(arrayResultado);
            //objTelefonos = objTelefonos.replace(/\\/g, "");
            values['resultado_monitoreo_pc'] = objResultados;
            ////////////////////////////////////////////
            // [FIN] Procesamiento de grid Resultado
            ////////////////////////////////////////////
        }
        else
        {
            me.getController('monitoreopc.ResultadoMonitoreoPc').sincronizar();
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
            Ext.getBody().mask('Guardando Monitoreo ...');
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

        var grid = me.getMonitoreoPcLista();
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
                win = me.getMonitoreoPcWindow(),
                isNew = record.phantom;

        if (!win) {
            win = Ext.widget('monitoreopc.monitoreopc.edit.window', {
                title: isNew ? 'Añadir Monitoreo de Punto Comunitario' : 'Editar Monitoreo de Punto Comunitario'
            });
        }

        win.show();
        win.down('form').loadRecord(record);
        win.doComponentLayout();
    },
    
    
    revisaResultados: function () {
        var me = this,
            grid = me.getResultadoMonitoreoPcLista(),
            store = grid.getStore(),
            res = true;
    
        var dd = store.getNewRecords();
        var ee = store.getUpdatedRecords();
        
        Ext.each(dd, function(item) {
            if ( item.get('resultado_monitoreo_pc') === '' )
            {
                res = false;
            }
        });
        
        
        Ext.each(ee, function(item) {
            if ( item.get('resultado_monitoreo_pc') === '' )
            {
                res = false;
            }
        });

        return res;
    }
});