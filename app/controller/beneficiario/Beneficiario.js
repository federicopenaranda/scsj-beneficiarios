Ext.define('sisscsj.controller.beneficiario.Beneficiario', {
    extend: 'sisscsj.controller.Base',
    boolBeneficiarioEdit: 0,
    stores: [
        'beneficiario.Beneficiario'
    ],
    views: [
        'beneficiario.Lista',
        'beneficiario.edit.Form',
        'beneficiario.edit.Window',
        'beneficiario.search.Form',
        'beneficiario.search.Window'
    ],
    refs: [
        {
            ref: 'BeneficiarioLista',
            selector: '[xtype=beneficiario.lista]'
        },
        {
            ref: 'BeneficiarioWindow',
            selector: '[xtype=beneficiario.edit.window]'
        },
        {
            ref: 'BeneficiarioForm',
            selector: '[xtype=beneficiario.edit.form]'
        },
        {
            ref: 'BeneficiarioTabPersonal',
            selector: '[xtype=beneficiario.edit.tab.personal]'
        },
        {
            ref: 'BeneficiarioTelefonosLista',
            selector: '[xtype=beneficiario.listatelefono]'
        },
        {
            ref: 'BeneficiarioEstadoCivilLista',
            selector: '[xtype=beneficiario.listaestadocivil]'
        },
        {
            ref: 'BeneficiarioIdentificacionLista',
            selector: '[xtype=beneficiario.listatipoidentificacion]'
        },
        {
            ref: 'BeneficiarioOcupacionLista',
            selector: '[xtype=beneficiario.listaocupacion]'
        },
        {
            ref: 'BeneficiarioTrabajoLista',
            selector: '[xtype=beneficiario.listatrabajo]'
        },
        {
            ref: 'BeneficiarioEstadoLista',
            selector: '[xtype=beneficiario.listaestadobeneficiario]'
        },
        {
            ref: 'BeneficiarioEntidadLista',
            selector: '[xtype=beneficiario.listaentidad]'
        },
        {
            ref: 'BeneficiarioUnidadEducativaLista',
            selector: '[xtype=beneficiario.listaunidadeducativa]'
        },
        {
            ref: 'BeneficiarioHistoriaSocialLista',
            selector: '[xtype=beneficiario.listahistoriasocial]'
        },
        {
            ref: 'BeneficiarioSearchWindow',
            selector: '[xtype=beneficiario.search.window]'
        },
        {
            ref: 'BeneficiarioSearchForm',
            selector: '[xtype=beneficiario.search.form]'
        },
        {
            ref: 'BeneficiarioFieldNivel',
            selector: '[xtype=beneficiario.edit.form] combo#fk_id_nivel'
        },
        {
            ref: 'BeneficiarioFieldCurso',
            selector: '[xtype=beneficiario.edit.form] combo#fk_id_curso'
        },
        {
            ref: 'BeneficiarioSearchFieldNivel',
            selector: '[xtype=beneficiario.search.form] combo#fk_id_nivel'
        },
        {
            ref: 'BeneficiarioSearchFieldCurso',
            selector: '[xtype=beneficiario.search.form] combo#fk_id_curso'
        },
        {
            ref: 'BeneficiarioFoto',
            selector: '[xtype=beneficiario.edit.form] #displayimage'
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
                'grid[xtype=beneficiario.lista]': {
                    beforerender: this.loadRecords,
                    itemdblclick: this.edit,
                    selectionchange: this.manejaBotones,
                    afterrender: this.manejaBotones
                },
                'grid[xtype=beneficiario.lista] button#add': {
                    click: this.add
                },
                'grid[xtype=beneficiario.lista] button#edit': {
                    click: this.edit
                },
                'grid[xtype=beneficiario.lista] button#delete': {
                    click: this.remove
                },
                'grid[xtype=beneficiario.lista] button#buscar': {
                    click: this.showSearch
                },
                'grid[xtype=beneficiario.lista] menuitem#clear': {
                    click: this.clearSearch
                },
                'window[xtype=beneficiario.edit.window] button#save': {
                    click: this.upload
                },
                'window[xtype=beneficiario.edit.window] button#cancel': {
                    click: this.close
                },
                '[xtype=beneficiario.edit.tab.organizacion]': {
                    activate: this.revisaCodigo
                },
                'window[xtype=beneficiario.search.window] button#search': {
                    click: this.search
                },
                'window[xtype=beneficiario.search.window] button#cancel': {
                    click: this.close
                },
                
                /////////////////////////////////////////////////////////////////
                // Reportes
                /////////////////////////////////////////////////////////////////
                'grid[xtype=beneficiario.lista] menuitem#ficha_social_familiar': {
                    click: this.repFichaSocialFamiliar
                },
                '[xtype=beneficiario.edit.form] combo#fk_id_nivel': {
                    select: this.filtraCurso,
                    change: this.filtraCurso
                },
                '[xtype=beneficiario.search.form] combo#fk_id_nivel': {
                    select: this.filtraSearchCurso,
                    change: this.filtraSearchCurso
                }
            },
            global: {},
            store: {},
            proxy: {}
        });
    },
    
    filtraSearchCurso: function ( combo, records, eOpts ) {
        var me = this,
                utilit = me.getBeneficiarioSearchFieldCurso(),
                value = combo.getValue();

        if (value)
            utilit.setDisabled(false);
        else
        {
            utilit.setDisabled(true);
            utilit.setValue('');
        }
    },
    
    filtraCurso: function ( combo, records, eOpts ) {
        var me = this,
                utilit = me.getBeneficiarioFieldCurso(),
                value = combo.getValue();

        if (value)
            utilit.setDisabled(false);
        else
        {
            utilit.setDisabled(true);
            utilit.setValue('');
        }
    },


    clearSearch: function( button, e, eOpts ) {
        var me = this,
            grid = me.getBeneficiarioLista(),
            store = grid.getStore();
        // clear filter
        store.clearFilter( false );
    },


    showSearch: function( button, e, eOpts ) {
        var me = this,
            win = me.getBeneficiarioSearchWindow();
        // if window exists, show it; otherwise, create new instance
        if( !win ) {
            win = Ext.widget( 'beneficiario.search.window', {
                title: 'Buscar Beneficiario'
            });
        }
        // show window
        win.show();
        win.doComponentLayout();
    },


    search: function( button, e, eOpts ) {
        var me = this,
            win = me.getBeneficiarioSearchWindow(),
            form = win.down( 'form' ),
            grid = me.getBeneficiarioLista(),
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


    /*reporte1: function() {
        var me = this,
                fd = me.getFileDownloader();

        fd.load({
            url: sisscsj.app.globals.globalServerPath + 'reporte/reporte1',
            params: {
                start: '2014-01-01',
                limit: '2014-06-01'
            }
        });
    },*/


    repFichaSocialFamiliar: function() {
        var me = this,
                fd = me.getFileDownloader();
        var grid = me.getBeneficiarioLista();
        var selected = grid.getSelectionModel().getSelection();
        
        if (selected.length === 1)
        {
            var rec = selected[0];
            var data = rec.getData();

            fd.load({
                url: sisscsj.app.globals.globalServerPath + 'reporte/reporte2',
                params: {
                    id: data['id_beneficiario']
                }
            });
        }
    },


    /*reporte5: function() {
        var me = this,
                fd = me.getFileDownloader();
        var grid = me.getBeneficiarioLista();
        var selected = grid.getSelectionModel().getSelection();
        
        if (selected.length === 1)
        {
            var rec = selected[0];
            var data = rec.getData();

            fd.load({
                url: sisscsj.app.globals.globalServerPath + 'reporte/reporte5',
                params: {
                    id: data['id_beneficiario']
                }
            });
        }
    },*/


    manejaBotones: function ( record, index, eOpts ){
        var me = this,
                grid = me.getBeneficiarioLista(),
                records = grid.getSelectionModel().getSelection();

        var botonEdit = grid.down("[xtype='toolbar'] button#edit");
        var botonDelete = grid.down("[xtype='toolbar'] button#delete");
        var botonEvaluaciones = grid.down("[xtype='toolbar'] button#evaluaciones");
        var botonReportes = grid.down("[xtype='toolbar'] button#reportes");

        if (records.length > 0)
        {
            botonEvaluaciones.enable();
            botonEdit.enable();
            botonDelete.enable();
            botonReportes.enable();
        }
        else
        {
            botonEvaluaciones.disable();
            botonEdit.disable();
            botonDelete.disable();
            botonReportes.disable();
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
        
        me.boolBeneficiarioEdit = 1;

        var grid = me.getBeneficiarioLista();
        var record = grid.getSelectionModel().getSelection()[0];
        // show window
        me.showEditWindow(record);
    },

    
    add: function(button, e, eOpts) {
        var me = this,
                record = Ext.create('sisscsj.model.beneficiario.Beneficiario');
        
        me.boolBeneficiarioEdit = 0;

        // show window
        me.showEditWindow(record);
    },
    
    
    upload: function (button, e, eOpts) {
        var me = this,
                win = button.up('window'),
                form = win.down('form');
        
        var uploadform = form.down('#uploadform');
        var uploadfield = uploadform.down('#fotografia_beneficiario');
        var tmp = uploadfield.getValue();
        
        if ( !form.isValid() )
        {
            Ext.Msg.alert('Error de Validación', 'Por favor revise los datos del formulario.');
            return;
        }
       
        if ( tmp === '' )
        {
            //Ext.Msg.alert('Error de Validación', 'Debe cargar una foto.');
            me.save(button, e, eOpts, tmp);
            //return;
        }
        else
        {
            uploadform.submit({
                url: sisscsj.app.globals.globalServerPath + 'beneficiario/subir',
                //url: 'http://sistema.sociedadsanjose.org/sisscsj/yii/index.php/beneficiario/subir',
                waitMsg: 'Cargando foto ...',
                success: function (f, a) {
                    console.log("UPLOAD SUCCESS!!!");
                    var result = Ext.JSON.decode(a.response.responseText);
                    console.log(result.msg.registros);
                    me.save(button, e, eOpts, result.msg.registros);
                },
                failure: function (f, a) {
                    console.log("UPLOAD SUCCESS!!!");
                    console.log(a.response);
                    return;
                }
            });
        }
    },


    save: function(button, e, eOpts, foto_beneficiario) {
        var me = this,
                grid = me.getBeneficiarioLista(),
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
        
        if ( !me.revisaTelefonos() )
        {
            Ext.Msg.alert('Error de Validación', 'Por favor revise los datos de Teléfonos.');
            return;
        }
        
        if ( !me.revisaEstadoCivil() )
        {
            Ext.Msg.alert('Error de Validación', 'Por favor revise los datos del Estado Civil.');
            return;
        }
        
        if ( !me.revisaTipoIdentificacion() )
        {
            Ext.Msg.alert('Error de Validación', 'Por favor revise los datos de Identificación.');
            return;
        }
        
        if ( !me.revisaUnidadEducativa() )
        {
            Ext.Msg.alert('Error de Validación', 'Por favor revise los datos de Unidad Educativa.');
            return;
        }
        
        var gridEstado = me.getBeneficiarioEstadoLista(),
                gridEntidad = me.getBeneficiarioEntidadLista(),
                storeEstado = gridEstado.getStore(),
                storeEntidad = gridEntidad.getStore(),
                recNewStoreEstado = storeEstado.getCount(),
                recNewStoreEntidad = storeEntidad.getCount();

        if ( recNewStoreEstado === 0 || recNewStoreEntidad === 0 )
        {
            Ext.Msg.alert('Error de Validación', 'Un beneficiario debe estar asignado a una Entidad y debe tener un Estado.');
            return;
        }
        
        if ( me.boolBeneficiarioEdit === 0 )
        {
            var codField = form.down('#codigo_beneficiario');
            var tmp = codField.getValue();
            
            values['codigo_beneficiario'] = tmp;
        
            ////////////////////////////////////////////
            // [INICIO] Procesamiento de grid Teléfonos
            ////////////////////////////////////////////
            var telefonos = me.getBeneficiarioTelefonosLista(); // your grid
            var telefonos_store = telefonos.getStore();     // your grid's store    
            var telefonos_selected = telefonos_store.getRange();  // getRange = select all records

            var arrayTelefonos = []; // start with empty array
            Ext.each(telefonos_selected, function(item) {
                // add the fields that you want to include
                var tmpTelefonos = {
                    numero_beneficiario_telefono: item.get('numero_beneficiario_telefono'),
                    tipo_telefono: item.get('tipo_telefono'),
                    emergencia_beneficiario_telefono: item.get('emergencia_beneficiario_telefono')
                };
                arrayTelefonos.push(tmpTelefonos); // push this to the array
            }, this);

            var objTelefonos = Ext.encode(arrayTelefonos);
            //objTelefonos = objTelefonos.replace(/\\/g, "");
            values['beneficiario_telefono'] = objTelefonos;
            ////////////////////////////////////////////
            // [FIN] Procesamiento de grid Teléfonos
            ////////////////////////////////////////////




            ////////////////////////////////////////////////////
            // [INICIO] Procesamiento de grid Estado Civil
            ////////////////////////////////////////////////////
            var estado_civil = me.getBeneficiarioEstadoCivilLista(); // your grid
            var estado_civil_store = estado_civil.getStore();     // your grid's store    
            var estado_civil_selected = estado_civil_store.getRange();  // getRange = select all records

            var arrayEstadoCivil = []; // start with empty array
            Ext.each(estado_civil_selected, function(item) {
                // add the fields that you want to include
                var tmpEstadoCivil = {
                    fk_id_estado_civil: item.get('fk_id_estado_civil'),  
                    estado_beneficiario_estado_civil: item.get('estado_beneficiario_estado_civil'),  
                    fecha_asignacion_beneficiario_estado_civil: item.get('fecha_asignacion_beneficiario_estado_civil')
                };
                arrayEstadoCivil.push(tmpEstadoCivil); // push this to the array
            }, this);

            var objEstadoCivil = Ext.encode(arrayEstadoCivil);
            //objTelefonos = objTelefonos.replace(/\\/g, "");
            values['beneficiario_estado_civil'] = objEstadoCivil;
            ////////////////////////////////////////////
            // [FIN] Procesamiento de grid Estado Civil
            ////////////////////////////////////////////


            //////////////////////////////////////////////////////////
            // [INICIO] Procesamiento de grid Tipo de Identificación
            //////////////////////////////////////////////////////////
            var tipo_identificacion = me.getBeneficiarioIdentificacionLista(); // your grid
            var tipo_identificacion_store = tipo_identificacion.getStore();     // your grid's store    
            var tipo_identificacion_selected = tipo_identificacion_store.getRange();  // getRange = select all records

            var arrayTipoIdentificacion = []; // start with empty array
            Ext.each(tipo_identificacion_selected, function(item) {
                // add the fields that you want to include
                var tmpTipoIdentificacion = {
                    fk_id_tipo_identificacion: item.get('fk_id_tipo_identificacion'),  
                    numero_tipo_identificacion: item.get('numero_tipo_identificacion'),
                    primario_tipo_identificacion: item.get('primario_tipo_identificacion')
                };
                arrayTipoIdentificacion.push(tmpTipoIdentificacion); // push this to the array
            }, this);

            var objTipoIdentificacion = Ext.encode(arrayTipoIdentificacion);
            values['beneficiario_tipo_identificacion'] = objTipoIdentificacion;
            /////////////////////////////////////////////////////////
            // [FIN] Procesamiento de grid Tipo de Identificación
            /////////////////////////////////////////////////////////



            //////////////////////////////////////////////////////////
            // [INICIO] Procesamiento de grid Ocupación
            //////////////////////////////////////////////////////////
            var ocupacion = me.getBeneficiarioOcupacionLista(); // your grid
            var ocupacion_store = ocupacion.getStore();     // your grid's store    
            var ocupacion_selected = ocupacion_store.getRange();  // getRange = select all records

            var arrayOcupacion = []; // start with empty array
            Ext.each(ocupacion_selected, function(item) {
                // add the fields that you want to include
                var tmpOcupacion = {
                    fk_id_ocupacion: item.get('fk_id_ocupacion'),  
                    fecha_beneficiario_ocupacion: item.get('fecha_beneficiario_ocupacion'),
                    estado_beneficiario_ocupacion: item.get('estado_beneficiario_ocupacion'),
                    observacion_beneficiario_ocupacion: item.get('observacion_beneficiario_ocupacion')
                };
                arrayOcupacion.push(tmpOcupacion); // push this to the array
            }, this);

            //var objOcupacion = Ext.encode(arrayOcupacion);
            values['beneficiario_ocupacion'] = Ext.encode(arrayOcupacion);
            /////////////////////////////////////////////////////////
            // [FIN] Procesamiento de grid Ocupación
            /////////////////////////////////////////////////////////




            //////////////////////////////////////////////////////////
            // [INICIO] Procesamiento de grid Trabajo
            //////////////////////////////////////////////////////////
            var trabajo = me.getBeneficiarioTrabajoLista(); // your grid
            var trabajo_store = trabajo.getStore();     // your grid's store    
            var trabajo_selected = trabajo_store.getRange();  // getRange = select all records

            var arrayTrabajo = []; // start with empty array
            Ext.each(trabajo_selected, function(item) {
                // add the fields that you want to include
                var tmpTrabajo = {
                    monto_ingreso_beneficiario_trabajo: item.get('monto_ingreso_beneficiario_trabajo'),  
                    tipo_trabajo_beneficiario_trabajo: item.get('tipo_trabajo_beneficiario_trabajo'),
                    estado_beneficiario_trabajo: item.get('estado_beneficiario_trabajo'),
                    descripcion_beneficiario_trabajo: item.get('descripcion_beneficiario_trabajo')
                };
                arrayTrabajo.push(tmpTrabajo); // push this to the array
            }, this);

            var objTrabajo = Ext.encode(arrayTrabajo);
            values['beneficiario_trabajo'] = objTrabajo;
            /////////////////////////////////////////////////////////
            // [FIN] Procesamiento de grid Trabajo
            /////////////////////////////////////////////////////////


            //////////////////////////////////////////////////////////
            // [INICIO] Procesamiento de grid Unidad Educativa
            //////////////////////////////////////////////////////////
            var unidad_educativa = me.getBeneficiarioUnidadEducativaLista(); // your grid
            var unidad_educativa_store = unidad_educativa.getStore();     // your grid's store    
            var unidad_educativa_selected = unidad_educativa_store.getRange();  // getRange = select all records

            var arrayUnidadEducativa = []; // start with empty array
            Ext.each(unidad_educativa_selected, function(item) {
                // add the fields that you want to include
                var tmpUnidadEducativa = {
                    fk_id_unidad_educativa: item.get('fk_id_unidad_educativa'),  
                    estado_beneficiario_unidad_educativa: item.get('estado_beneficiario_unidad_educativa')
                };
                arrayUnidadEducativa.push(tmpUnidadEducativa); // push this to the array
            }, this);

            var objUnidadEducativa = Ext.encode(arrayUnidadEducativa);
            values['beneficiario_unidad_educativa'] = objUnidadEducativa;
            /////////////////////////////////////////////////////////
            // [FIN] Procesamiento de grid Unidad Educativa
            /////////////////////////////////////////////////////////



            //////////////////////////////////////////////////////////
            // [INICIO] Procesamiento de grid Estado Beneficiario
            //////////////////////////////////////////////////////////
            var estado_beneficiario = me.getBeneficiarioEstadoLista(); // your grid
            var estado_beneficiario_store = estado_beneficiario.getStore();     // your grid's store    
            var estado_beneficiario_selected = estado_beneficiario_store.getRange();  // getRange = select all records

            var arrayEstadoBeneficiario = []; // start with empty array
            Ext.each(estado_beneficiario_selected, function(item) {
                // add the fields that you want to include
                var tmpEstadoBeneficiario = {
                    fk_id_estado_beneficiario: item.get('fk_id_estado_beneficiario'),  
                    fk_id_beneficiario_tipo: item.get('fk_id_beneficiario_tipo'),
                    fk_id_edades_beneficiario: item.get('fk_id_edades_beneficiario'),
                    fk_id_tipo_actor_beneficiario: item.get('fk_id_tipo_actor_beneficiario'),
                    fecha_asignacion_estado_beneficiario: item.get('fecha_asignacion_estado_beneficiario'),
                    observaciones_beneficiario_estado_beneficiario: item.get('observaciones_beneficiario_estado_beneficiario'),
                    modalidad_estado_beneficiario: item.get('modalidad_estado_beneficiario')
                };
                arrayEstadoBeneficiario.push(tmpEstadoBeneficiario); // push this to the array
            }, this);

            var objEstadoBeneficiario = Ext.encode(arrayEstadoBeneficiario);
            values['beneficiario_estado_beneficiario'] = objEstadoBeneficiario;
            /////////////////////////////////////////////////////////
            // [FIN] Procesamiento de grid Estado Beneficiario
            /////////////////////////////////////////////////////////


            //////////////////////////////////////////////////////////
            // [INICIO] Procesamiento de grid Entidad Beneficiario
            //////////////////////////////////////////////////////////
            var entidad_beneficiario = me.getBeneficiarioEntidadLista(); // your grid
            var entidad_beneficiario_store = entidad_beneficiario.getStore();     // your grid's store    
            var entidad_beneficiario_selected = entidad_beneficiario_store.getRange();  // getRange = select all records

            var arrayEntidadBeneficiario = []; // start with empty array
            Ext.each(entidad_beneficiario_selected, function(item) {
                // add the fields that you want to include
                var tmpEntidadBeneficiario = {
                    fk_id_entidad: item.get('fk_id_entidad'),  
                    fecha_vinculacion_beneficiario_entidad: item.get('fecha_vinculacion_beneficiario_entidad'),
                    fecha_retiro_beneficiario_entidad: item.get('fecha_retiro_beneficiario_entidad'),
                    razon_retiro_beneficiario: item.get('razon_retiro_beneficiario'),
                    estado_beneficiario_entidad: item.get('estado_beneficiario_entidad'),
                    fecha_creacion_beneficiario_entidad: item.get('fecha_creacion_beneficiario_entidad')
                };
                arrayEntidadBeneficiario.push(tmpEntidadBeneficiario); // push this to the array
            }, this);

            var objEntidadBeneficiario = Ext.encode(arrayEntidadBeneficiario);
            values['beneficiario_entidad'] = objEntidadBeneficiario;
            /////////////////////////////////////////////////////////
            // [FIN] Procesamiento de grid Entidad Beneficiario
            /////////////////////////////////////////////////////////

        
        
        
            //////////////////////////////////////////////////////////
            // [INICIO] Procesamiento de grid Historia Social
            //////////////////////////////////////////////////////////
            var historia_social_beneficiario = me.getBeneficiarioHistoriaSocialLista();
            var historia_social_beneficiario_store = historia_social_beneficiario.getStore();
            var historia_social_beneficiario_selected = historia_social_beneficiario_store.getRange();

            var arrayHistoriaSocialBeneficiario = [];
            Ext.each(historia_social_beneficiario_selected, function(item) {
                // add the fields that you want to include
                var tmpHistoriaSocialBeneficiario = {
                    historia_social: item.get('historia_social'),  
                    dinamica_familiar_historia_social: item.get('dinamica_familiar_historia_social'),
                    situacion_actual_historia_social: item.get('situacion_actual_historia_social'),
                    estado_historia_social: item.get('estado_historia_social')
                };
                arrayHistoriaSocialBeneficiario.push(tmpHistoriaSocialBeneficiario); // push this to the array
            }, this);

            var objHistoriaSocialBeneficiario = Ext.encode(arrayHistoriaSocialBeneficiario);
            values['historia_social'] = objHistoriaSocialBeneficiario;
            /////////////////////////////////////////////////////////
            // [FIN] Procesamiento de grid Historia Social
            /////////////////////////////////////////////////////////

        }
        else
        {
            me.getController('beneficiario.BeneficiarioEntidad').sincronizar();
            me.getController('beneficiario.BeneficiarioEstado').sincronizar();
            me.getController('beneficiario.BeneficiarioEstadoCivil').sincronizar();
            me.getController('beneficiario.BeneficiarioOcupacion').sincronizar();
            me.getController('beneficiario.BeneficiarioTelefono').sincronizar();
            me.getController('beneficiario.BeneficiarioTipoIdentificacion').sincronizar();
            me.getController('beneficiario.BeneficiarioTrabajo').sincronizar();
            me.getController('beneficiario.BeneficiarioUnidadEducativa').sincronizar();
            me.getController('beneficiario.BeneficiarioHistoriaSocial').sincronizar();
        }
        
        
        /////////////////////////////////////////////////////////////////
        // [INICIO] Procesamiento de campo Idiomas
        /////////////////////////////////////////////////////////////////
        var arrayIdiomas = []; // start with empty array
        var arrayLength = values['beneficiario_idioma'].length;
        for (var i = 0; i < arrayLength; i++) {
            if (values['beneficiario_idioma'][i] !== '')
            {
                // add the fields that you want to include
                var tmpIdiomas = {
                    fk_id_idioma: values['beneficiario_idioma'][i]
                };
                arrayIdiomas.push(tmpIdiomas); // push this to the array
            }
        }
        var objIdiomas = Ext.encode(arrayIdiomas);
        values['beneficiario_idioma'] = objIdiomas;
        /////////////////////////////////////////////////////////////////
        // [FIN] Procesamiento de campo Idiomas
        /////////////////////////////////////////////////////////////////


        /////////////////////////////////////////////////////////////////
        // [INICIO] Procesamiento de campo Otros Programas
        /////////////////////////////////////////////////////////////////
        var arrayOtrosProgramas = []; // start with empty array
        var arrayLength = values['beneficiario_otros_programas'].length;
        for (var i = 0; i < arrayLength; i++) {
            if (values['beneficiario_otros_programas'][i] !== '')
            {
                // add the fields that you want to include
                var tmpOtrosProgramas = {
                    fk_id_otros_programas: values['beneficiario_otros_programas'][i]
                };
                arrayOtrosProgramas.push(tmpOtrosProgramas); // push this to the array
            }
        }
        var objOtrosProgramas = Ext.JSON.encode(arrayOtrosProgramas);
        values['beneficiario_otros_programas'] = objOtrosProgramas;
        /////////////////////////////////////////////////////////////////
        // [FIN] Procesamiento de campo Otros Programas
        /////////////////////////////////////////////////////////////////



        /////////////////////////////////////////////////////////////////
        // [INICIO] Procesamiento de campo Actividades Favoritas
        /////////////////////////////////////////////////////////////////
        var arrayActividadFavorita = []; // start with empty array
        var arrayLength = values['beneficiario_actividad_favorita'].length;
        for (var i = 0; i < arrayLength; i++) {
            if ( values['beneficiario_actividad_favorita'][i] !== '' )
            {
                // add the fields that you want to include
                var tmpActividadFavorita = {
                    fk_id_actividad_favorita: values['beneficiario_actividad_favorita'][i]
                };
                arrayActividadFavorita.push(tmpActividadFavorita); // push this to the array
            }
        }
        var objActividadFavorita = Ext.encode(arrayActividadFavorita);
        values['beneficiario_actividad_favorita'] = objActividadFavorita;
        /////////////////////////////////////////////////////////////////
        // [FIN] Procesamiento de campo Actividades Favoritas
        /////////////////////////////////////////////////////////////////
        

        /////////////////////////////////////////////////////////////////
        // [INICIO] Procesamiento de campo Donante
        /////////////////////////////////////////////////////////////////
        var arrayDonante = []; // start with empty array
        var arrayLength = values['beneficiario_donante'].length;
        for (var i = 0; i < arrayLength; i++) {
            if ( values['beneficiario_donante'][i] !== '' )
            {
                // add the fields that you want to include
                var tmpDonante = {
                    fk_id_donante: values['beneficiario_donante'][i]
                };
                arrayDonante.push(tmpDonante); // push this to the array
            }
        }
        var objDonante = Ext.encode(arrayDonante);
        values['beneficiario_donante'] = objDonante;
        /////////////////////////////////////////////////////////////////
        // [FIN] Procesamiento de campo Donante
        /////////////////////////////////////////////////////////////////


        values['fotografia_beneficiario'] = foto_beneficiario;

        // set values of record from form
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
            Ext.getBody().mask('Guardando Beneficiario ...');
            // if new record...
            if (record.phantom) {
                // reject any other changes
                store.rejectChanges();
                // add the new record
                store.add(record);
            }
            // persist the record
            store.sync(callbacks);
            grid.getSelectionModel().clearSelections();
        }
        else
        {
            console.log("record.dirty");
            console.log(record.dirty);
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

        var grid = me.getBeneficiarioLista();
        var store = grid.getStore();
        var record = grid.getSelectionModel().getSelection()[0];
        
        // show confirmation before continuing
        Ext.Msg.confirm({
            title: 'Atención',
            msg: '¿Esta seguro que desea eliminar este Beneficiario?. Esta acción no puede ser deshecha.',
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
                        /**
                         * On failure, add record back to store at correct index
                         * @param {Ext.data.Model[]} records
                         * @param {Ext.data.Operation} operation
                         */
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
                win = me.getBeneficiarioWindow(),
                isNew = record.phantom;
        // if window exists, show it; otherwise, create new instance
        if (!win) {
            win = Ext.widget('beneficiario.edit.window', {
                title: isNew ? 'Añadir Beneficiario' : 'Editar Beneficiario'
            });
        }
        // show window
        win.show();
        // load form with data
        win.down('form').loadRecord(record);
        win.doComponentLayout();
        
        var foto = me.getBeneficiarioFoto(),
                src = record.getData().fotografia_beneficiario;
        
        if (src)
            foto.setSrc(sisscsj.app.globals.globalImagePath + src);
        else
        {
            foto.setSrc('');
            foto.setSize(1,1);
        }
    },
    
    
    revisaTelefonos: function () {
        var me = this,
            grid = me.getBeneficiarioTelefonosLista(),
            store = grid.getStore(),
            res = true;
    
        var dd = store.getNewRecords();
        var ee = store.getUpdatedRecords();
        
        Ext.each(dd, function(item) {
            if ( item.get('numero_beneficiario_telefono') === '' || 
                    item.get('tipo_telefono') === '' || 
                    item.get('emergencia_beneficiario_telefono') === null )
            {
                res = false;
            }
        });
        
        
        Ext.each(ee, function(item) {
            if ( item.get('numero_beneficiario_telefono') === '' || 
                    item.get('tipo_telefono') === '' || 
                    item.get('emergencia_beneficiario_telefono') === null )
            {
                res = false;
            }
        });

        return res;
    },
    
    
    revisaEstadoCivil: function () {
        var me = this,
            grid = me.getBeneficiarioEstadoCivilLista(),
            store = grid.getStore(),
            res = true;
    
        var newRec = store.getNewRecords();
        var updRec = store.getUpdatedRecords();
        
        Ext.each(newRec, function(item) {
            if ( 
                    item.get('fk_id_estado_civil') === null || 
                    item.get('estado_beneficiario_estado_civil') === null
                )
            {
                res = false;
            }
        });
        
        
        Ext.each(updRec, function(item) {
            if ( 
                    item.get('fk_id_estado_civil') === null || 
                    item.get('estado_beneficiario_estado_civil') === null
                )
            {
                res = false;
            }
        });

        return res;
    },
    
    
    revisaTipoIdentificacion: function () {
        var me = this,
            grid = me.getBeneficiarioIdentificacionLista(),
            store = grid.getStore(),
            res = true;
    
        var newRec = store.getNewRecords();
        var updRec = store.getUpdatedRecords();
        
        Ext.each(newRec, function(item) {
            if ( 
                    item.get('fk_id_tipo_identificacion') === null || 
                    item.get('numero_tipo_identificacion') === '' ||
                    item.get('primario_tipo_identificacion') === null
                )
            {
                res = false;
            }
        });
        
        
        Ext.each(updRec, function(item) {
            if ( 
                    item.get('fk_id_tipo_identificacion') === null || 
                    item.get('numero_tipo_identificacion') === '' ||
                    item.get('primario_tipo_identificacion') === null
                )
            {
                res = false;
            }
        });

        return res;
    },
    
    
    revisaUnidadEducativa: function () {
        var me = this,
            grid = me.getBeneficiarioUnidadEducativaLista(),
            store = grid.getStore(),
            res = true;
    
        var newRec = store.getNewRecords();
        var updRec = store.getUpdatedRecords();
        
        Ext.each(newRec, function(item) {
            if ( 
                    item.get('fk_id_unidad_educativa') === null || 
                    item.get('estado_beneficiario_unidad_educativa') === null
                )
            {
                res = false;
            }
        });
        
        
        Ext.each(updRec, function(item) {
            if ( 
                    item.get('fk_id_unidad_educativa') === null || 
                    item.get('estado_beneficiario_unidad_educativa') === null
                )
            {
                res = false;
            }
        });

        return res;
    },
    
    
    revisaCodigo: function () {
        var me = this,
            tab = me.getBeneficiarioTabPersonal(),
            form = tab.up('form'),
            values = form.getValues();
        
        if (  (!values['apellido_paterno_beneficiario'] && !values['apellido_materno_beneficiario']) || !values['fecha_nacimiento_beneficiario'] || !values['primer_nombre_beneficiario'] )
        {
            Ext.Msg.alert('Datos de Código', 'Debe llenar los datos de Primer Nombre, Apellido Paterno y Fecha de Nacimiento para generar el código.');
        }
        else
        {
            var prinom = values['primer_nombre_beneficiario'];
            var segnom = values['segundo_nombre_beneficiario'];
            var apmat = values['apellido_materno_beneficiario'];
            var appat = values['apellido_paterno_beneficiario'];
            var fenac = values['fecha_nacimiento_beneficiario'];

            prinom = prinom.substring(0, 1);
            fenac = Ext.util.Format.date(fenac, 'Ymd');
            
            appat = (appat !== '') ? appat.substring(0, 1) : '' ;
            segnom = (segnom !== '') ? segnom.substring(0, 1) : '' ;
            apmat = (apmat !== '') ? apmat.substring(0, 1) : '' ;

            var codigo = prinom.toUpperCase() + segnom.toUpperCase() + appat.toUpperCase() + apmat.toUpperCase() + '-' + fenac;
            form.down('#codigo_beneficiario').setValue(codigo);
        }
    }
});