Ext.define('sisscsj.controller.monitoreopc.ResultadoMonitoreoPc', {
    extend: 'sisscsj.controller.Base',
    stores: [
        'monitoreopc.ResultadoMonitoreoPc'
    ],
    views: [
        'monitoreopc.MonitoreoPc.Lista',
        'monitoreopc.ResultadoMonitoreoPc.Lista',
        'monitoreopc.ResultadoMonitoreoPc.edit.Form',
        'monitoreopc.ResultadoMonitoreoPc.edit.Window'
    ],
    refs: [
        {
            ref: 'MonitoreoPcLista',
            selector: '[xtype=monitoreopc.monitoreopc.lista]'
        },
        {
            ref: 'ResultadoMonitoreoPcLista',
            selector: '[xtype=monitoreopc.resultadomonitoreopc.lista]'
        },
        {
            ref: 'ResultadoMonitoreoPcWindow',
            selector: '[xtype=monitoreopc.resultadomonitoreopc.edit.window]'
        },
        {
            ref: 'ResultadoMonitoreoPcForm',
            selector: '[xtype=monitoreopc.resultadomonitoreopc.edit.form]'
        }
    ],
    init: function() {
        this.listen({
            controller: {},
            component: {
                'grid[xtype=monitoreopc.monitoreopc.lista]': {

                },
                'grid[xtype=monitoreopc.resultadomonitoreopc.lista]': {
                    beforerender: this.loadRecords,
                    itemdblclick: this.edit,
                    selectionchange: this.manejaBotones,
                    afterrender: this.manejaBotones
                },
                /*'grid[xtype=monitoreopc.resultadomonitoreopc.lista] button#add': {
                    click: this.add
                },*/
                'grid[xtype=monitoreopc.resultadomonitoreopc.lista] button#edit': {
                    click: this.edit
                },
                'grid[xtype=monitoreopc.resultadomonitoreopc.lista] button#delete': {
                    click: this.remove
                },
                'window[xtype=monitoreopc.resultadomonitoreopc.edit.window] button#save': {
                    click: this.save
                },
                'window[xtype=monitoreopc.resultadomonitoreopc.edit.window] button#cancel': {
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
        var grid = me.getResultadoMonitoreoPcLista();
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

        // clear any fliters that have been applied
        store.clearFilter(true);
        var contMonitoreoPc = me.getController('monitoreopc.MonitoreoPc');
        
        // Si se esta editando un monitoreo filtrar los resultados por su ID
        if ( contMonitoreoPc.boolMonitoreoPcEdit === 1)
        {
            var grid2 = me.getMonitoreoPcLista();
            var dd = grid2.getSelectionModel().getSelection();

            if ( dd.length === 1 )
            {
                var record = dd[0];
                var data = record.getData();

                store.filter( 'fk_id_monitoreo_punto_comunitario', data['id_monitoreo_punto_comunitario'] );
            }
        }
        else
        {
            //store.filter( 'estado_ambito_monitoreo_pc', 1 );
            
            Ext.data.JsonP.request ({
                url: sisscsj.app.globals.globalServerPath + 'AmbitoMonitoreoPc?filter=[{"property":"estado_ambito_monitoreo_pc","value":1}]',
                params: {
                    page: 1,
                    start: 0,
                    limit: 100
                },
                success: function( response, options ) {
                    Ext.each ( response.registros, function (rec, value, myself) {
                        var record = Ext.create('sisscsj.model.monitoreopc.ResultadoMonitoreoPc');
                        record.set('fk_id_ambito_monitoreo_pc', rec.id_ambito_monitoreo_pc);
                        record.set('nombre_ambito_monitoreo_pc', rec.nombre_ambito_monitoreo_pc);
                        record.set('indicador_ambito_monitoreo_pc', rec.indicador_ambito_monitoreo_pc);
                        record.set('nombre_caracteristica_monitoreo_pc', rec.nombre_caracteristica_monitoreo_pc);
                        store.add(record);
                    });
                },
                failure: function( response, options ) {
                    Ext.Msg.alert( 'Atención', 'Un error ocurrió durante su petición. Por favor intente nuevamente.' );
                }
            });

        }
    },


    edit: function(view, record, item, index, e, eOpts) {
        var me = this;
        var grid = me.getResultadoMonitoreoPcLista();
        var record = grid.getSelectionModel().getSelection()[0];
        
        me.showEditWindow(record);
    },


    /*add: function(button, e, eOpts) {
        var me = this,
                record = Ext.create('sisscsj.model.monitoreopc.ResultadoMonitoreoPc');

        // show window
        me.showEditWindow(record);
    },*/


    save: function(button, e, eOpts) {
        var me = this,
                grid = me.getResultadoMonitoreoPcLista(),
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

        var grid = me.getResultadoMonitoreoPcLista();
        var store = grid.getStore();
        var record = grid.getSelectionModel().getSelection()[0];
        
        // show confirmation before continuing
        Ext.Msg.confirm({
            title: 'Atención',
            msg: '¿Esta seguro que desea eliminar este Resultado?. Esta acción no puede ser deshecha.',
            icon: Ext.Msg.QUESTION,
            buttonText: {
                yes: 'Eliminar',
                no: 'Cancelar'
            },
            fn: function(buttonId, text, opt) 
            {
                if (buttonId === 'yes') {
                    store.remove(record);
                    /*store.sync({
                        failure: function(records, operation) {
                            store.rejectChanges();
                        }
                    });*/
                }
            }
        });
    },


    showEditWindow: function(record) {
        var me = this,
                win = me.getResultadoMonitoreoPcWindow(),
                isNew = record.phantom;

        if (!win) {
            win = Ext.widget('monitoreopc.resultadomonitoreopc.edit.window', {
                //title: isNew ? 'Añadir Resultado' : 'Editar Resultado'
                title: 'Editar Resultado'
            });
        }

        win.show();
        win.down('form').loadRecord(record);
        win.doComponentLayout();
    },


    sincronizar: function() {
        var me = this,
            grid = me.getResultadoMonitoreoPcLista(),
            store = grid.getStore();

        store.sync();
    }
});