Ext.define('sisscsj.controller.actividad_proyecto.ActividadProyecto', {
    extend: 'sisscsj.controller.Base',
    stores: [
        'actividad_proyecto.ActividadProyecto',
        'opciones.TipoActividad',
        'opciones.Lugar'
    ],
    views: [
        'actividad_proyecto.Lista',
        'actividad_proyecto.edit.Form',
        'actividad_proyecto.edit.Window',
        'actividad_proyecto.edit.tab.ActividadProyecto',
        'actividad_proyecto.edit.tab.TipoActividad',
        'actividad_proyecto.edit.tab.ResultadoActividad'
    ],
    refs: [
        {
            ref: 'ActividadProyectoLista',
            selector: '[xtype=actividad_proyecto.lista]'
        },
        {
            ref: 'ActividadProyectoWindow',
            selector: '[xtype=actividad_proyecto.edit.window]'
        },
        {
            ref: 'ActividadProyectoForm',
            selector: '[xtype=actividad_proyecto.edit.form]'
        },
        {
            ref: 'ActividadProyectoTipoParticipanteWindow',
            selector: '[xtype=actividad_proyecto.actividad_tipo_participante.edit.window]'
        }
    ],
    init: function() {
        this.listen({
            controller: {},
            component: {
                'grid[xtype=actividad_proyecto.lista]': {
                    beforerender: this.loadRecords,
                    itemdblclick: this.edit,
                    selectionchange: this.manejaBotones,
                    afterrender: this.manejaBotones
                },
                'grid[xtype=actividad_proyecto.lista] button#add': {
                    click: this.add
                },
                'grid[xtype=actividad_proyecto.lista] button#edit': {
                    click: this.edit
                },
                'grid[xtype=actividad_proyecto.lista] button#delete': {
                    click: this.remove
                },
                'window[xtype=actividad_proyecto.edit.window] button#save': {
                    click: this.save
                },
                'window[xtype=actividad_proyecto.edit.window] button#cancel': {
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
        var grid = me.getActividadProyectoLista();
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
        var me = this,
                store = grid.getStore();
        // clear any fliters that have been applied
        store.clearFilter(true);
        // load the store
        store.load();
    },


    edit: function(view, record, item, index, e, eOpts) {
        var me = this;

        var grid = me.getActividadProyectoLista();
        var record = grid.getSelectionModel().getSelection()[0];
        // show window
        me.showEditWindow(record);
    },


    add: function(button, e, eOpts) {
        var me = this,
                record = Ext.create('sisscsj.model.actividad_proyecto.ActividadProyecto');
        // show window
        me.showEditWindow(record);
    },


    save: function(button, e, eOpts) {
        var me = this,
                grid = me.getActividadProyectoLista(),
                store = grid.getStore(),
                win = button.up('window'),
                form = win.down('form'),
                record = form.getRecord(),
                values = form.getValues(),
                callbacks;

        if ( form.isValid() )
        {
            values['fk_id_usuario'] = null;
            values['fk_id_gestion'] = sisscsj.app.globals.globalGestionActual;

            /////////////////////////////////////////////////////////////////
            // [INICIO] Procesamiento de campo Resultado
            /////////////////////////////////////////////////////////////////
            var arrayResultado = []; // start with empty array
            var arrayLength = values['resultado_actividad'].length;
            for (var i = 0; i < arrayLength; i++) {
                // add the fields that you want to include
                var tmpResultado = {
                    fk_id_resultado: values['resultado_actividad'][i]
                };
                arrayResultado.push(tmpResultado); // push this to the array
            }
            var objResultado = Ext.encode(arrayResultado);
            values['resultado_actividad'] = objResultado;
            /////////////////////////////////////////////////////////////////
            // [FIN] Procesamiento de campo Resultado
            /////////////////////////////////////////////////////////////////

            /////////////////////////////////////////////////////////////////
            // [INICIO] Procesamiento de campo Tipo de ActividadProyecto
            /////////////////////////////////////////////////////////////////
            var arrayTipoActividadProyecto = []; // start with empty array
            var arrayLength = values['actividad_proyecto_tipo_actividad'].length;
            for (var i = 0; i < arrayLength; i++) {
                if ( values['actividad_proyecto_tipo_actividad'][i] > 0 )
                {
                    var tmpTipoActividadProyecto = {
                        fk_id_tipo_actividad: values['actividad_proyecto_tipo_actividad'][i]
                    };
                    arrayTipoActividadProyecto.push(tmpTipoActividadProyecto); // push this to the array
                }
            }
            var objTipoActividadProyecto = Ext.encode(arrayTipoActividadProyecto);
            values['actividad_proyecto_tipo_actividad'] = objTipoActividadProyecto;
            /////////////////////////////////////////////////////////////////
            // [FIN] Procesamiento de campo Tipo de ActividadProyecto
            /////////////////////////////////////////////////////////////////

        }
        else
        {
            Ext.Msg.alert('Error de Validación', 'Por favor revise los datos del formulario.');
            return;
        }

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
        Ext.getBody().mask('Guardando Actividad de Proyecto ...');
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

        var grid = me.getActividadProyectoLista();
        var store = grid.getStore();
        var record = grid.getSelectionModel().getSelection()[0];
        
        // show confirmation before continuing
        Ext.Msg.confirm('Atención', '¿Esta seguro que desea eliminar esta Actividad de Proyecto?. Esta acción no puede ser deshecha.', function(buttonId, text, opt) {
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
                win = me.getActividadProyectoWindow(),
                isNew = record.phantom;
        // if window exists, show it; otherwise, create new instance
        if (!win) {
            win = Ext.widget('actividad_proyecto.edit.window', {
                title: isNew ? 'Añadir Actividad de Proyecto' : 'Editar Actividad de Proyecto'
            });
        }
        // show window
        win.show();
        // load form with data
        win.down('form').loadRecord(record);
        win.doComponentLayout();
    },


    cancel: function(editor, context, eOpts) {
        // if the record is a phantom, remove from store and grid
        if (context.record.phantom) {
            context.store.remove(context.record);
        }
    }


});