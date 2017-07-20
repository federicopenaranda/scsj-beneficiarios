Ext.define('sisscsj.controller.beneficiario.BeneficiarioHistoriaSocial', {
    extend: 'sisscsj.controller.Base',
    stores: [
        'beneficiario.BeneficiarioHistoriaSocial'
    ],
    views: [
        'beneficiario.ListaHistoriaSocial',
        'beneficiario.edit.FormHistoriaSocial',
        'beneficiario.edit.WindowHistoriaSocial'
    ],
    refs: [
        {
            ref: 'BeneficiarioHistoriaSocialLista',
            selector: '[xtype=beneficiario.listahistoriasocial]'
        },
        {
            ref: 'BeneficiarioHistoriaSocialWindow',
            selector: '[xtype=beneficiario.edit.windowhistoriasocial]'
        },
        {
            ref: 'BeneficiarioHistoriaSocialForm',
            selector: '[xtype=beneficiario.edit.formhistoriasocial]'
        },
        {
            ref: 'BeneficiarioHistoriaSocialFamiliaField',
            selector: '[xtype=beneficiario.edit.formhistoriasocial] combo#beneficiario_familia'
        },
        {
            ref: 'BeneficiarioHistoriaSocialHistoriaSocialField',
            selector: '[xtype=beneficiario.edit.formhistoriasocial] textarea#historia_social'
        },
        {
            ref: 'BeneficiarioHistoriaSocialDinamicaField',
            selector: '[xtype=beneficiario.edit.formhistoriasocial] textarea#dinamica_familiar_historia_social'
        },
        {
            ref: 'BeneficiarioHistoriaSocialSituacionField',
            selector: '[xtype=beneficiario.edit.formhistoriasocial] textarea#situacion_actual_historia_social'
        },
        {
            ref: 'BeneficiarioLista',
            selector: '[xtype=beneficiario.lista]'
        }
    ],
    init: function() {
        this.listen({
            controller: {},
            component: {
                'grid[xtype=beneficiario.listahistoriasocial]': {
                    beforerender: this.loadRecords,
                    itemdblclick: this.edit,
                    select: this.habilitarBotones,
                    delselect: this.deshabilitarBotones
                },
                'grid[xtype=beneficiario.listahistoriasocial] button#add': {
                    click: this.add
                },
                'grid[xtype=beneficiario.listahistoriasocial] button#edit': {
                    click: this.edit
                },
                'grid[xtype=beneficiario.listahistoriasocial] button#delete': {
                    click: this.remove
                },
                'window[xtype=beneficiario.edit.windowhistoriasocial] button#save': {
                    click: this.save
                },
                'window[xtype=beneficiario.edit.windowhistoriasocial] button#cancel': {
                    click: this.close
                },
                '[xtype=beneficiario.edit.formhistoriasocial] combo#beneficiario_familia': {
                    change: this.cargaHistoriaSocial/*,
                    beforequery: this.filtraBeneficiario*/
                }
            },
            global: {},
            store: {},
            proxy: {}
        });
    },
    
    /*filtraBeneficiario: function (queryPlan, eOpts) {
        var me = this,
                combo = me.getBeneficiarioHistoriaSocialFamiliaField(),
                store = combo.getStore(),
                grid = me.getBeneficiarioLista(),
                selected= grid.getSelectionModel().getSelection(),
                data = selected[0].getData();
        
        store.clearFilter(true);
        store.filter('fk_id_beneficiario', data.id_beneficiario);
    },*/
    
    
    cargaHistoriaSocial: function (object, newValue, oldValue, eOpts) {
        
        if (!newValue || typeof(newValue) === 'string' )
            return;
        
        var me = this,
                historia = me.getBeneficiarioHistoriaSocialHistoriaSocialField(),
                dinamica = me.getBeneficiarioHistoriaSocialDinamicaField(),
                situacion = me.getBeneficiarioHistoriaSocialSituacionField(),
                arr = [], json, res;
        
        arr.push(
                {
                    property: 'fk_id_beneficiario',
                    value: newValue
                },
                {
                    property: 'estado_historia_social',
                    value: 1
                }
        );

        json = Ext.JSON.encode(arr);

        Ext.data.JsonP.request({
            url: sisscsj.app.globals.globalServerPath + 'HistoriaSocial',
            params: {
                filter: json,
                limit: 100,
                page: 1,
                start: 0
            },
            success: function( response, options ) {
                console.log(response.success);
                if( response.success === 'true' )
                {
                    if ( response.registros.length > 0 )
                    {
                        res = response.registros[0];
                        
                        historia.setValue(res.historia_social);
                        dinamica.setValue(res.dinamica_familiar_historia_social);
                        situacion.setValue(res.situacion_actual_historia_social);
                    }
                } 
                else {
                    Ext.Msg.alert( 'Error', 'Error al conectar al consultar el Historial Social.' );
                }
            },
            failure: function( response, options ) {
                Ext.Msg.alert( 'Atención', 'Un error ocurrió al ingresar. Por favor intenta nuevamente.' );
            }
        });
    },


    loadRecords: function(grid, eOpts) {
        var me = this;
        var store = grid.getStore();
        var botonEdit = grid.down("[xtype='toolbar'] button#edit");
        var botonDelete = grid.down("[xtype='toolbar'] button#delete");
        // clear any fliters that have been applied
        store.clearFilter(true);
        var contBeneficiario = me.getController('beneficiario.Beneficiario');
        
        if ( contBeneficiario.boolBeneficiarioEdit === 1)
        {
            var grid2 = me.getBeneficiarioLista();
            var dd = grid2.getSelectionModel().getSelection();

            if ( dd.length === 1 )
            {
                var record = dd[0];
                var data = record.getData();

                store.filter( 'fk_id_beneficiario', data['id_beneficiario'] );
            }
        }
        
        // Se deshabilita o habilita los botones de edit y delete
        // según se haya elegido un registro o no.
        var recStore = store.getRange();
        var arrRecords = grid.getSelectionModel().getSelection();

        if ( recStore.length === 0 || arrRecords.length === 0 )
        {
            botonEdit.disable();
            botonDelete.disable();
        }
    },

    
    habilitarBotones: function ( record, index, eOpts ){
        var me = this;
        var grid = me.getBeneficiarioHistoriaSocialLista();
        var botonEdit = grid.down("[xtype='toolbar'] button#edit");
        var botonDelete = grid.down("[xtype='toolbar'] button#delete");

        if ( botonEdit.disabled || botonDelete.disabled )
        {
            botonEdit.enable();
            botonDelete.enable();
        }
    },


    deshabilitarBotones: function ( record, index, eOpts ){
        var me = this;
        var grid = me.getBeneficiarioLista();
        var records = grid.getSelectionModel().getSelection();

        if (records.length > 0)
        {
            var grid2 = me.getBeneficiarioHistoriaSocialLista();
            var botonEdit = grid2.down("[xtype='toolbar'] button#edit");
            var botonDelete = grid2.down("[xtype='toolbar'] button#delete");

            botonEdit.disable();
            botonDelete.disable();
        }
    },


    cancel: function(editor, context, eOpts) {
        // if the record is a phantom, remove from store and grid
        if (context.record.phantom) {
            context.store.remove(context.record);
        }
    },


    edit: function(records, index, node, eOpts) {
        var me = this;

        var grid = me.getBeneficiarioHistoriaSocialLista();
        var record = grid.getSelectionModel().getSelection()[0];
        // show window
        me.showEditWindow(record);
    },


    add: function(button, e, eOpts) {
        var me = this,
            record = Ext.create('sisscsj.model.beneficiario.BeneficiarioHistoriaSocial');
        
        var grid1 = me.getBeneficiarioLista();
        var recSeleccionados = grid1.getSelectionModel().getSelection();
        var contBeneficiario = me.getController('beneficiario.Beneficiario');

        // Beneficiario ya creado
        if ( recSeleccionados.length === 1 && contBeneficiario.boolBeneficiarioEdit === 1 )
        {
            var record1 = recSeleccionados[0];
            var data1 = record1.getData();

            record.set('fk_id_beneficiario', data1['id_beneficiario']);

            me.showEditWindow(record);
        }
        else
        {
            // Beneficiario nuevo
            if ( contBeneficiario.boolBeneficiarioEdit === 0 )
            {
                me.showEditWindow(record);
            }
            else
            {
                console.log('[BeneficiarioHistoriaSocial] Error al recuperar el ID del beneficiario');
                return 'Error';
            }
        }
        // [FIN]
    },


    save: function(button, e, eOpts) {
        var me = this,
                grid = me.getBeneficiarioHistoriaSocialLista(),
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
        var grid = me.getBeneficiarioHistoriaSocialLista();
        var store = grid.getStore();
        var record = grid.getSelectionModel().getSelection()[0];
        var botonEdit = grid.down("[xtype='toolbar'] button#edit");
        var botonDelete = grid.down("[xtype='toolbar'] button#delete");
        var contBeneficiario = me.getController('beneficiario.Beneficiario');

        // Se esta eliminando un registro del grid de Estado Civil
        // pero de un beneficiario nuevo. Solo se quita del store.
        if ( contBeneficiario.boolBeneficiarioEdit === 0 )
        {
            store.remove(record);
        }
        // Se esta eliminando un registro del grid de Estado Civil
        // pero de un beneficiario ya creado. Si es un registro recién creado (phantom == true)
        // solo se quita del store. Si no es un registro recién creado se lo quita del store
        // y de la base de datos (sync).
        else
        {
            if ( record.phantom )
            {
                store.remove(record);
            }
            else
            {
                Ext.Msg.confirm({
                    title: 'Atención',
                    msg: '¿Esta seguro que desea eliminar esta Historia Social?. Esta acción no puede ser deshecha.',
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
            }
        }

        var recStore = store.getRange();
        var arrRecords = grid.getSelectionModel().getSelection();

        if ( recStore.length === 0 || arrRecords.length === 0 )
        {
            botonEdit.disable();
            botonDelete.disable();
        }
    },


    showEditWindow: function(record) {
        var me = this,
                win = me.getBeneficiarioHistoriaSocialWindow(),
                isNew = record.phantom;
        // if window exists, show it; otherwise, create new instance
        if (!win) {
            win = Ext.widget('beneficiario.edit.windowhistoriasocial', {
                title: isNew ? 'Añadir Historia Social' : 'Editar Historia Social'
            });
        }
        // show window
        win.show();
        // load form with data
        win.down('form').loadRecord(record);
        win.doComponentLayout();
    },


    sincronizar: function() {
        var me = this,
                grid = me.getBeneficiarioHistoriaSocialLista(),
                store = grid.getStore();
        
        store.sync();
    }
});