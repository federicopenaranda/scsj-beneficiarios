Ext.define('sisscsj.controller.familia.Familia', {
    extend: 'sisscsj.controller.Base',
    boolFamiliaEdit: 0,
    stores: [
        'familia.Familia'
    ],
    views: [
        'familia.Lista',
        'familia.edit.Form',
        'familia.edit.Window'
    ],
    refs: [
        {
            ref: 'FamiliaLista',
            selector: '[xtype=familia.lista]'
        },
        {
            ref: 'FamiliaWindow',
            selector: '[xtype=familia.edit.window]'
        },
        {
            ref: 'FamiliaForm',
            selector: '[xtype=familia.edit.form]'
        },
        {
            ref: 'FamiliaInfoTab',
            selector: '[xtype=familia.edit.tab.infofamilia]'
        },
        
        //////////////////////////////////////////////////////////////
        //  Referencias a Servicios Básicos
        //////////////////////////////////////////////////////////////
        {
            ref: 'FamiliaServiciosLista',
            selector: '[xtype=familia.listaserviciobasico]'
        },
        {
            ref: 'FamiliaWindowServiciosBasicos',
            selector: '[xtype=familia.edit.windowserviciobasico]'
        },
        {
            ref: 'FamiliaFormServiciosBasicos',
            selector: '[xtype=familia.edit.formserviciobasico]'
        },
        {
            ref: 'FamiliaTabServiciosBasicos',
            selector: '[xtype=familia.edit.tab.serviciobasico]'
        },

        //////////////////////////////////////////////////////////////
        //  Referencias a Tipo de Casa
        //////////////////////////////////////////////////////////////
        {
            ref: 'FamiliaTipoCasaLista',
            selector: '[xtype=familia.listatipocasa]'
        },
        {
            ref: 'FamiliaWindowTipoCasa',
            selector: '[xtype=familia.edit.windowtipocasa]'
        },
        {
            ref: 'FamiliaFormTipoCasa',
            selector: '[xtype=familia.edit.formtipocasa]'
        },
        {
            ref: 'FamiliaTabTipoCasa',
            selector: '[xtype=familia.edit.tab.tipocasa]'
        },
        
        //////////////////////////////////////////////////////////////
        //  Referencias a Eventos Vitales
        //////////////////////////////////////////////////////////////
        {
            ref: 'FamiliaEventoVitalLista',
            selector: '[xtype=familia.eventovitallista]'
        },
        {
            ref: 'FamiliaWindowEventoVital',
            selector: '[xtype=familia.edit.windoweventovital]'
        },
        {
            ref: 'FamiliaFormEventoVital',
            selector: '[xtype=familia.edit.formeventovital]'
        },
        {
            ref: 'FamiliaTabEventoVital',
            selector: '[xtype=familia.edit.tab.eventovital]'
        },
        
        //////////////////////////////////////////////////////////////
        //  Referencias a Dirección
        //////////////////////////////////////////////////////////////
        {
            ref: 'FamiliaDireccionLista',
            selector: '[xtype=familia.direccionlista]'
        },
        {
            ref: 'FamiliaWindowDireccion',
            selector: '[xtype=familia.edit.windowsdireccion]'
        },
        {
            ref: 'FamiliaFormDireccion',
            selector: '[xtype=familia.edit.formdireccion]'
        },
        {
            ref: 'FamiliaTabDireccion',
            selector: '[xtype=familia.edit.tab.direccion]'
        },
        
        //////////////////////////////////////////////////////////////
        //  Referencias a Miembros
        //////////////////////////////////////////////////////////////
        {
            ref: 'FamiliaMiembrosLista',
            selector: '[xtype=familia.miembroslista]'
        },
        {
            ref: 'FamiliaWindowMiembros',
            selector: '[xtype=familia.edit.windowmiembros]'
        },
        {
            ref: 'FamiliaFormMiembros',
            selector: '[xtype=familia.edit.formmiembros]'
        },
        {
            ref: 'FamiliaTabMiembros',
            selector: '[xtype=familia.edit.tab.miembros]'
        },
        
        //////////////////////////////////////////////////////////////
        //  Busqueda
        //////////////////////////////////////////////////////////////
        {
            ref: 'FamiliaSearchWindow',
            selector: '[xtype=familia.search.window]'
        },
        {
            ref: 'FamiliaSearchForm',
            selector: '[xtype=familia.search.form]'
        }
    ],
    init: function() {
        this.listen({
            controller: {},
            component: {
                'grid[xtype=familia.lista]': {
                    beforerender: this.loadRecords,
                    itemdblclick: this.edit,
                    selectionchange: this.manejaBotones,
                    afterrender: this.manejaBotones
                },
                'grid[xtype=familia.lista] button#add': {
                    click: this.add
                },
                'grid[xtype=familia.lista] button#edit': {
                    click: this.edit
                },
                'grid[xtype=familia.lista] button#delete': {
                    click: this.remove
                },
                'window[xtype=familia.edit.window] button#save': {
                    click: this.save
                },
                'window[xtype=familia.edit.window] button#cancel': {
                    click: this.close
                },
                'grid[xtype=familia.lista] button#buscar': {
                    click: this.showSearch
                },
                'grid[xtype=familia.lista] menuitem#clear': {
                    click: this.clearSearch
                },
                'window[xtype=familia.search.window] button#search': {
                    click: this.search
                },
                'window[xtype=familia.search.window] button#cancel': {
                    click: this.close
                }
            },
            global: {},
            store: {},
            proxy: {}
        });
    },


    clearSearch: function( button, e, eOpts ) {
        var me = this,
            grid = me.getFamiliaLista(),
            store = grid.getStore();
        // clear filter
        store.clearFilter( false );
    },


    showSearch: function( button, e, eOpts ) {
        var me = this,
            win = me.getFamiliaSearchWindow();
        // if window exists, show it; otherwise, create new instance
        if( !win ) {
            win = Ext.widget( 'familia.search.window', {
                title: 'Buscar Familia'
            });
        }
        // show window
        win.show();
        win.doComponentLayout();
    },


    search: function( button, e, eOpts ) {
        var me = this,
            win = me.getFamiliaSearchWindow(),
            form = win.down( 'form' ),
            grid = me.getFamiliaLista(),
            store = grid.getStore(),
            values = form.getValues(),
            filters=[];
        // loop over values to create filters
        Ext.Object.each( values, function( key, value, myself ) {
            if( !Ext.isEmpty( value ) ) {
                filters.push({
                    property: key,
                    value: value
                });
            }
        });
        // clear store filters
        store.clearFilter( true );
        store.filter( filters );
        // close window
        win.hide();
    },


    manejaBotones: function ( record, index, eOpts ){
        var me = this,
                grid = me.getFamiliaLista(),
                records = grid.getSelectionModel().getSelection(),
                botonEdit = grid.down("[xtype='toolbar'] button#edit"),
                botonDelete = grid.down("[xtype='toolbar'] button#delete");

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
        var me = this,
                grid = me.getFamiliaLista(),
                record = grid.getSelectionModel().getSelection()[0];

        me.boolFamiliaEdit = 1;

        // show window
        me.showEditWindow(record);
    },


    add: function(button, e, eOpts) {
        var me = this,
                record = Ext.create('sisscsj.model.familia.Familia');
        
        me.boolFamiliaEdit = 0;
        me.showEditWindow(record);
    },


    save: function(button, e, eOpts) {
        var me = this,
                grid = me.getFamiliaLista(),
                store = grid.getStore(),
                win = button.up('window'),
                form = win.down('form'),
                record = form.getRecord(),
                values = form.getValues(),
                callbacks;
        
        // Valida el formulario
        if ( form.isValid() )
        {
            var gridMiembros = me.getFamiliaMiembrosLista(),
                    storeMiembros = gridMiembros.getStore(),
                    recStoreMiembros = storeMiembros.getCount();

            if ( recStoreMiembros === 0 )
            {
                Ext.Msg.alert('Error de Validación', 'Una familia debe tener al menos un Miembro.');
                return;
            }
            
            // Creación de familia nueva con sus otros datos
            if ( me.boolFamiliaEdit === 0 && record.phantom )
            {
                values['familia_direccion']         = me.saveTablaSecundaria( me.getFamiliaDireccionLista() );
                values['evento_vital_familia']      = me.saveTablaSecundaria( me.getFamiliaEventoVitalLista() );
                values['familia_servicio_basico']   = me.saveTablaSecundaria( me.getFamiliaServiciosLista() );
                values['familia_tipo_casa']         = me.saveTablaSecundaria( me.getFamiliaTipoCasaLista() );
                values['beneficiario_familia']      = me.saveTablaSecundaria( me.getFamiliaMiembrosLista() );
            }
            else
            {
                me.getController('familia.FamiliaDireccion').sincronizar();
                me.getController('familia.FamiliaEventoVital').sincronizar();
                me.getController('familia.FamiliaServicioBasico').sincronizar();
                me.getController('familia.FamiliaTipoCasa').sincronizar();
                me.getController('familia.FamiliaMiembros').sincronizar();
            }

            /////////////////////////////////////////////////////////////////
            // [INICIO] Procesamiento de campo Método Planificación Familiar
            /////////////////////////////////////////////////////////////////
            var arrayMetodos = []; // start with empty array
            var arrayLength = values['familia_metodo_planificacion_familiar'].length;

            for (var i = 0; i < arrayLength; i++) {
                if ( values['familia_metodo_planificacion_familiar'][i] > 0 )
                {
                    var tmpMetodos = {
                        fk_id_metodo_planificacion_familiar: values['familia_metodo_planificacion_familiar'][i]
                    };
                    arrayMetodos.push(tmpMetodos); // push this to the array
                }
            }

            var objMetodos = Ext.encode(arrayMetodos);
            values['familia_metodo_planificacion_familiar'] = objMetodos;
            /////////////////////////////////////////////////////////////////
            // [FIN] Procesamiento de campo Método Planificación Familiar
            /////////////////////////////////////////////////////////////////

            record.set(values);

            if (record.dirty)
            {
                callbacks = {
                    success: function(records, operation) {
                        store.reload();
                        win.close();
                    },
                    failure: function(records, operation) {
                        store.rejectChanges();
                    }
                };

                Ext.getBody().mask('Guardando Familia ...');

                if (record.phantom) {
                    store.rejectChanges();
                    store.add(record);
                }

                store.sync(callbacks);
                grid.getSelectionModel().clearSelections();
            }
        }
        else
        {
            Ext.Msg.alert('Error de Validación', 'Por favor revise los datos del formulario.');
            return;
        }
    },
            

    close: function(button, e, eOpts) {
        var win = button.up('window');
        win.close();
    },


    remove: function() {
        var me = this;

        var grid = me.getFamiliaLista();
        var store = grid.getStore();
        var record = grid.getSelectionModel().getSelection()[0];
        
        // show confirmation before continuing
        Ext.Msg.confirm({
            title: 'Atención',
            msg: '¿Esta seguro que desea eliminar esta Familia?. Esta acción no puede ser deshecha.',
            icon: Ext.Msg.QUESTION,
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
                win = me.getFamiliaWindow(),
                isNew = record.phantom;
        // if window exists, show it; otherwise, create new instance
        if (!win) {
            win = Ext.widget('familia.edit.window', {
                title: isNew ? 'Añadir Familia' : 'Editar Familia'
            });
        }
        // show window
        win.show();
        win.down('form').loadRecord(record);
        win.doComponentLayout();
    },


    saveTablaSecundaria: function ( grid ) {
        var store = grid.getStore(),
            records = store.getModifiedRecords();

        // Guarda registros de estado de una familia nueva
        if (records.length > 0)
        {
            var array = [];

            for (var i = 0; i < records.length; i++) {
                var rec = records[i].getData();
                var tmp = rec;
                array.push(tmp);
            }

            var obj = Ext.encode(array);
            return obj;
        }
        else
        {
            return '';
        }
    },


    cancel: function(editor, context, eOpts) {
        // if the record is a phantom, remove from store and grid
        if (context.record.phantom) {
            context.store.remove(context.record);
        }
    }
});