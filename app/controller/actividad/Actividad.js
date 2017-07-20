Ext.define('sisscsj.controller.actividad.Actividad', {
    extend: 'sisscsj.controller.Base',
    stores: [
        'actividad.Actividad',
        'opciones.TipoActividad',
        'opciones.SubAreaActividad',
        'opciones.Lugar',
        'beneficiario.Beneficiario'
    ],
    views: [
        'actividad.Lista',
        'actividad.edit.Form',
        'actividad.edit.Window',
        'actividad.edit.tab.Actividad',
        'actividad.edit.tab.SubArea',
        'actividad.edit.tab.Beneficiarios',
        'actividad.ListaBeneficiarios'
    ],
    refs: [
        {
            ref: 'ActividadLista',
            selector: '[xtype=actividad.lista]'
        },
        {
            ref: 'ActividadWindow',
            selector: '[xtype=actividad.edit.window]'
        },
        {
            ref: 'ActividadForm',
            selector: '[xtype=actividad.edit.form]'
        },
        {
            ref: 'ActividadBeneficiariosLista',
            selector: '[xtype=actividad.listabeneficiarios]'
        },
        {
            ref: 'ActividadPersonalLista',
            selector: '[xtype=actividad.listapersonal]'
        }
    ],
    init: function() {
        this.listen({
            controller: {},
            component: {
                'grid[xtype=actividad.lista]': {
                    beforerender: this.loadRecords,
                    itemdblclick: this.edit,
                    selectionchange: this.manejaBotones,
                    afterrender: this.manejaBotones
                },
                'grid[xtype=actividad.lista] button#add': {
                    click: this.add
                },
                'grid[xtype=actividad.lista] button#edit': {
                    click: this.edit
                },
                'grid[xtype=actividad.lista] button#delete': {
                    click: this.remove
                },
                'window[xtype=actividad.edit.window] button#save': {
                    click: this.save
                },
                'window[xtype=actividad.edit.window] button#cancel': {
                    click: this.close
                },
                'grid[xtype=actividad.listabeneficiarios]': {
                    beforerender: this.loadRecords,
                    selectionchange: this.actualizaTituloBeneficiarios
                },
                'grid[xtype=actividad.listabeneficiarios] checkbox#entornofamiliar': {
                    change: this.anadeEntornoFamiliar
                },
                'grid[xtype=actividad.listapersonal]': {
                    beforerender: this.loadRecords,
                    selectionchange: this.actualizaTituloPersonal
                }
            },
            global: {},
            store: {},
            proxy: {}
        });
    },


    manejaBotones: function ( record, index, eOpts ){
        var me = this;
        var grid = me.getActividadLista();
        var records = grid.getSelectionModel().getSelection();

        var botonEdit = grid.down("[xtype='toolbar'] button#edit");
        var botonDelete = grid.down("[xtype='toolbar'] button#delete");
        var botonAsistencia = grid.down("[xtype='toolbar'] button#asistencia");

        if (records.length > 0)
        {
            botonEdit.enable();
            botonDelete.enable();
            botonAsistencia.enable();
        }
        else
        {
            botonEdit.disable();
            botonDelete.disable();
            botonAsistencia.disable();
        }
    },

    
    anadeEntornoFamiliar: function (objeto, newValue, oldValue, eOpts) {
        var me = this;
        var grid = me.getActividadBeneficiariosLista();
        grid.entornoFamiliar = newValue;
    },

    actualizaTituloBeneficiarios: function (view, nodes) {
        var me = this;
        var len = nodes.length,
            suffix = len === 1 ? '' : 's',
            str = 'Participantes de la Actividad. <i>({0} Beneficiario{1} seleccionado{1})</i>';
        
        var grid = me.getActividadBeneficiariosLista();
        grid.setTitle(Ext.String.format(str, len, suffix));
    },

    actualizaTituloPersonal: function (view, nodes) {
        var me = this;
        var len = nodes.length,
            suffix = len === 1 ? '' : 's',
            str = 'Personal de la Actividad. <i>({0} Usuario{1} seleccionado{1})</i>';
        
        var grid = me.getActividadPersonalLista();
        grid.setTitle(Ext.String.format(str, len, suffix));
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

        var grid = me.getActividadLista();
        var record = grid.getSelectionModel().getSelection()[0];
        // show window
        me.showEditWindow(record);
    },


    add: function(button, e, eOpts) {
        var me = this,
                record = Ext.create('sisscsj.model.actividad.Actividad');
        // show window
        me.showEditWindow(record);
    },
    
    
    getInvalidFields: function (form) {
        var invalidFields = [];

        Ext.suspendLayouts();
        form.getForm().getFields().filterBy(function (field) {
            if (field.validate())
                return;
            invalidFields.push(field);
        });
        Ext.resumeLayouts(true);
    },


    save: function(button, e, eOpts) {
        var me = this,
                grid = me.getActividadLista(),
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
            // [INICIO] Procesamiento de campo Sub Area
            /////////////////////////////////////////////////////////////////
            var arraySubAreas = []; // start with empty array
            var arrayLength = values['actividad_area_actividad'].length;
            for (var i = 0; i < arrayLength; i++) {
                // add the fields that you want to include
                var tmpSubAreas = {
                    fk_id_sub_area: values['actividad_area_actividad'][i]
                };
                arraySubAreas.push(tmpSubAreas); // push this to the array
            }
            var objSubAreas = Ext.encode(arraySubAreas);
            values['actividad_area_actividad'] = objSubAreas;
            /////////////////////////////////////////////////////////////////
            // [FIN] Procesamiento de campo Sub Area
            /////////////////////////////////////////////////////////////////

            /////////////////////////////////////////////////////////////////
            // [INICIO] Procesamiento de campo Tipo de Actividad
            /////////////////////////////////////////////////////////////////
            var arrayTipoActividad = []; // start with empty array
            var arrayLength = values['actividad_tipo_actividad'].length;
            for (var i = 0; i < arrayLength; i++) {
                if ( values['actividad_tipo_actividad'][i] > 0 )
                {
                    var tmpTipoActividad = {
                        fk_id_tipo_actividad: values['actividad_tipo_actividad'][i]
                    };
                    arrayTipoActividad.push(tmpTipoActividad); // push this to the array
                }
            }
            var objTipoActividad = Ext.encode(arrayTipoActividad);
            values['actividad_tipo_actividad'] = objTipoActividad;
            /////////////////////////////////////////////////////////////////
            // [FIN] Procesamiento de campo Tipo de Actividad
            /////////////////////////////////////////////////////////////////


            /////////////////////////////////////////////////////////////////
            // [INICIO] Procesamiento de campo Beneficiarios
            /////////////////////////////////////////////////////////////////
            var gridBeneficiariosActividad = me.getActividadBeneficiariosLista();
            var beneficiariosSeleccionados = gridBeneficiariosActividad.getSelectionModel().getSelection();

            if (beneficiariosSeleccionados.length === 0)
            {
                return null;
            }
            else
            {
                var arrayBenef = [];
                var arrayLength = beneficiariosSeleccionados.length;
                for (var i = 0; i < arrayLength; i++) {
                    var dataBenef = beneficiariosSeleccionados[i].getData();
                    var tmpBenef = {
                        fk_id_beneficiario: dataBenef['id_beneficiario']
                    };
                    arrayBenef.push(tmpBenef); // push this to the array
                }
                var objBenef = Ext.encode(arrayBenef);
                values['beneficiario_asistencia'] = objBenef;
            }
            /////////////////////////////////////////////////////////////////
            // [FIN] Procesamiento de campo Beneficiarios
            /////////////////////////////////////////////////////////////////

            /////////////////////////////////////////////////////////////////
            // [INICIO] Procesamiento de campo Personal
            /////////////////////////////////////////////////////////////////
            var gridPersonalActividad = me.getActividadPersonalLista();
            var personalSeleccionados = gridPersonalActividad.getSelectionModel().getSelection();

            if (personalSeleccionados.length === 0)
            {
                return null;
            }
            else
            {
                var arrayPersonal = [];
                var arrayLength = personalSeleccionados.length;
                for (var i = 0; i < arrayLength; i++) {
                    var dataPersonal = personalSeleccionados[i].getData();
                    var tmpPersonal = {
                        fk_id_usuario: dataPersonal['id_usuario']
                    };
                    arrayPersonal.push(tmpPersonal); // push this to the array
                }
                var objPersonal = Ext.encode(arrayPersonal);
                values['personal_asistencia'] = objPersonal;
            }
            /////////////////////////////////////////////////////////////////
            // [FIN] Procesamiento de campo Personal
            /////////////////////////////////////////////////////////////////


            /////////////////////////////////////////////////////////////////
            // [INICIO] Procesamiento de campo para incluir Entorno Familiar
            /////////////////////////////////////////////////////////////////
            var grid = me.getActividadBeneficiariosLista();
            var efActividad = (grid.entornoFamiliar) ? 1 : 0;
            values['incluir_entorno_familiar'] = efActividad;
            /////////////////////////////////////////////////////////////////
            // [FIN] Procesamiento de campo para incluir Entorno Familiar
            /////////////////////////////////////////////////////////////////
        }
        else
        {
            Ext.Msg.alert('Error de Validación', 'Por favor revise los datos del formulario.');
            me.getInvalidFields(form);
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
        Ext.getBody().mask('Guardando Actividad ...');
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

        var grid = me.getActividadLista();
        var store = grid.getStore();
        var record = grid.getSelectionModel().getSelection()[0];
        
        // show confirmation before continuing
        Ext.Msg.confirm('Atención', '¿Esta seguro que desea eliminar esta Actividad?. Esta acción no puede ser deshecha.', function(buttonId, text, opt) {
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
                win = me.getActividadWindow(),
                isNew = record.phantom;
        // if window exists, show it; otherwise, create new instance
        if (!win) {
            win = Ext.widget('actividad.edit.window', {
                title: isNew ? 'Añadir Actividad' : 'Editar Actividad'
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