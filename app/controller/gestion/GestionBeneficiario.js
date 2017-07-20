Ext.define('sisscsj.controller.gestion.GestionBeneficiario',{
    extend:'sisscsj.controller.Base',
    stores: [
            'gestion.GestionBeneficiario'
    ],
    views: [
            'gestion.GestionBeneficiarioLista',
            'gestion.edit.GestionBeneficiarioWindow',
            'gestion.Lista'
    ],
    refs: [
        {
            ref: 'GestionBeneficiarioLista',
            selector: '[xtype=gestion.gestionbeneficiariolista]'
        },
        {
           ref: 'GestionBeneficiarioForm',
           selector:'[xtype=gestion.edit.gestionbeneficiarioform]'
        },
        {
           ref: 'GestionBeneficiarioWindow',
           selector:'[xtype=gestion.edit.gestionbeneficiariowindow]'
        },
        {
           ref: 'GestionBeneficiarioInscripcionWindow',
           selector:'[xtype=gestion.edit.gestionbeneficiarioinscripcionwindow]'
        },
        {
           ref: 'GestionBeneficiarioInscripcionForm',
           selector:'[xtype=gestion.edit.gestionbeneficiarioinscripcionform]'
        },
        {
           ref: 'GestionLista',
           selector:'[xtype=gestion.lista]'
        }
    ],
    init:function(){
	  this.listen({
	   	 controller:{},
	   	 component:{
		'grid[xtype=gestion.gestionbeneficiariolista]': {
                    beforerender: this.loadRecords,
                    selectionchange: this.manejaBotones,
                    afterrender: this.manejaBotones,
                    itemdeletebuttonclick: this.remove
                },
                'grid[xtype=gestion.gestionbeneficiariolista] button#add': {
                    click: this.add
                },
                'grid[xtype=gestion.gestionbeneficiariolista] button#importagestionanterior': {
                    click: this.cargaGestionAnterior
                },
                'window[xtype=gestion.edit.gestionbeneficiariowindow] button#save': {
                    click: this.save
                },
                'window[xtype=gestion.edit.gestionbeneficiariowindow] button#cancel': {
                    click: this.close
                },
                'window[xtype=gestion.edit.gestionbeneficiarioinscripcionwindow] button#save': {
                    click: this.saveInscripcion
                },
                'window[xtype=gestion.edit.gestionbeneficiarioinscripcionwindow] button#cancel': {
                    click: this.close
                },
                'grid[xtype=gestion.lista] button#inscripcion': {
                    click: this.inscripcion
                }
            },
            global: {},
            store: {},
            proxy: {}
        });
    },
    
    cargaGestionAnterior: function () {
        var me = this,
            grid = me.getGestionBeneficiarioLista(),
            store = grid.getStore();
    
        var grid2 = me.getGestionLista();
        var recGestion = grid2.getSelectionModel().getSelection();
        
        if ( recGestion.length === 1 )
        {
            var record = recGestion[0];
            var data = record.getData();
        }
        else
        {
            return false;
        }
        

        Ext.data.JsonP.request({
            url: sisscsj.app.globals.globalServerPath + 'beneficiario/gestionbeneficiario',
            params: {
                id_gestion: data['id_gestion']
            },
            success: function( response, options ) {
                if( response.success == 'true' ) {
                    
                    var registros = response.registros;
                    
                    Ext.each (registros, function (beneficiario, value, myself) {
                        var recordGestionBeneficiario = Ext.create('sisscsj.model.gestion.GestionBeneficiario');
                        recordGestionBeneficiario.set('estado_gestion_beneficiario', 1);
                        recordGestionBeneficiario.set('fk_id_beneficiario', beneficiario.id_beneficiario);
                        store.add(recordGestionBeneficiario);
                    });
                    
                } 
                else {
                    Ext.Msg.alert( 'Error', response.msg );
                }
            },
            failure: function( response, options ) {
                Ext.Msg.alert( 'Atención', 'Un error ocurrió al ingresar. Por favor intenta nuevamente.' );
            }
            
        });
    },
    
    
    inscripcion: function () {
        var me = this,
            win = me.getGestionBeneficiarioWindow();
        // if window exists, show it; otherwise, create new instance
        if (!win) {
            win = Ext.widget('gestion.edit.gestionbeneficiariowindow', {
                title: 'Editar Inscritos'
            });
        }
        // show window
        win.show();
        win.doComponentLayout();
    },


    loadRecords: function(grid, eOpts) {
        var me = this,
                store = grid.getStore();
        store.clearFilter(true);

        // clear any fliters that have been applied
        store.clearFilter(true);

        var grid2 = me.getGestionLista();
        var dd = grid2.getSelectionModel().getSelection();

        if ( dd.length === 1 )
        {
            var record = dd[0];
            var data = record.getData();

            store.filter( 'fk_id_gestion', data['id_gestion'] );
        }
    },


    manejaBotones: function ( record, index, eOpts ){
       /* var me = this;
        var grid = me.getGestionBeneficiarioLista();
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
        }*/
    },


    cancel: function(editor, context, eOpts) {
        if (context.record.phantom) {
            context.store.remove(context.record);
        }
    },


    add: function(button, e, eOpts) {
        var me = this,
                record = Ext.create('sisscsj.model.gestion.GestionBeneficiario');
        // show window
        me.showEditWindow(record);
    },
    
    
    saveInscripcion: function (button, e, eOpts) {
        var me = this,
                grid = me.getGestionBeneficiarioLista(),
                store = grid.getStore(),
                win = button.up('window'),
                form = win.down('form'),
                record = form.getRecord(),
                values = form.getValues();
        
        record.set(values);
        
        Ext.data.JsonP.request ({
            url: sisscsj.app.globals.globalServerPath + 'Beneficiario',
            params: {
                start: '0',
                limit: '1',
                filter: '[{"property":"id_beneficiario","value":'+ values.fk_id_beneficiario + '}]'
            },
            success: function( response, options ) {
                var tmpData = response.registros[0];

                record.set('primer_nombre_beneficiario', tmpData.primer_nombre_beneficiario);
                record.set('segundo_nombre_beneficiario', tmpData.segundo_nombre_beneficiario);
                record.set('apellido_paterno_beneficiario', tmpData.apellido_paterno_beneficiario);
                record.set('apellido_materno_beneficiario', tmpData.apellido_materno_beneficiario);
                record.set('codigo_beneficiario', tmpData.codigo_beneficiario);
                
                if (!record.dirty) {
                    win.close();
                    return;
                }

                record.set('estado_gestion_beneficiario', 1);

                var gridGestion = me.getGestionLista();
                var selectionGestion = gridGestion.getSelectionModel().getSelection();

                if ( selectionGestion.length === 1 )
                {
                    var recordGestion = selectionGestion[0];
                    var dataGestion = recordGestion.getData();
                }

                record.set('fk_id_gestion', dataGestion['id_gestion']);
                
                store.add(record);
                win.close();
                
                
            },
            failure: function( response, options ) {
                Ext.Msg.alert( 'Atención', 'Un error ocurrió durante su petición. Por favor intente nuevamente.' );
            }
        });
    },


    save: function(button, e, eOpts) {
        var me = this,
                grid = me.getGestionBeneficiarioLista(),
                store = grid.getStore(),
                win = button.up('window'),
                callbacks;
        
        if ( store.getRange().length === 0 )
        {
            win.close();
            return false;
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
        Ext.getBody().mask('Inscribiendo Beneficiarios ...');

        // persist the record
        store.sync(callbacks);
    },
    
    
    close: function(button, e, eOpts) {
        var me = this,
                win = button.up('window');
        // close the window
        win.close();
    },


    remove: function( grid, rowIndex, colIndex ) {
        var me = this;

        var grid = me.getGestionBeneficiarioLista();
        var store = grid.getStore();
        var record = store.getAt(rowIndex);
        
        Ext.Msg.confirm({
            title: 'Atención',
            msg: '¿Esta seguro que desea eliminar la inscripción del Beneficiario?. Esta acción no puede ser deshecha.',
            icon: Ext.Msg.QUESTION,
            buttonText: {
                yes: 'Eliminar',
                no: 'Cancelar'
            },
            fn: function(buttonId, text, opt) 
            {
                if (buttonId === 'yes') {
                    store.remove(record);
                }
            }
        });
    },


    showEditWindow: function(record) {
        var me = this,
                win = me.getGestionBeneficiarioInscripcionWindow(),
                isNew = record.phantom;

        if (!win) {
            win = Ext.widget('gestion.edit.gestionbeneficiarioinscripcionwindow', {
                title: 'Inscribir Beneficiario'
            });
        }

        win.show();
        win.down('form').loadRecord(record);
        win.doComponentLayout();
    }
});


