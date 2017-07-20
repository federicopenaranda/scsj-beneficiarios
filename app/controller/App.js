Ext.define('sisscsj.controller.App', {
    extend: 'sisscsj.controller.Base',
    views: [
        'Viewport',
        'layout.Menu',
        'layout.Center',
        'layout.Landing'
    ],
    refs: [
        {
            ref: 'Viewport',
            selector: '[xtype=viewport]'
        },
        {
            ref: 'Menu',
            selector: '[xtype=layout.menu]'
        },
        {
            ref: 'CenterRegion',
            selector: '[xtype=layout.center]'
        }
    ],
    init: function() {
        this.listen({
            controller: {
                  '#App': { tokenchange: this.dispatch }
                , '#opciones.ActividadFavorita': {tokenchange: this.dispatch}
                , '#opciones.AreaActividad': {tokenchange: this.dispatch}
                , '#opciones.AreaConocimientoBiblioteca': {tokenchange: this.dispatch}
                , '#opciones.BeneficiarioTipo': {tokenchange: this.dispatch}
                , '#opciones.Departamento': {tokenchange: this.dispatch}
                , '#opciones.Donante': {tokenchange: this.dispatch}
                , '#opciones.Provincia': {tokenchange: this.dispatch}
                , '#opciones.Localidad': {tokenchange: this.dispatch}
                , '#opciones.Diagnostico': {tokenchange: this.dispatch}
                , '#opciones.EnfermedadComun': {tokenchange: this.dispatch}
                , '#opciones.EntidadSalud': {tokenchange: this.dispatch}
                , '#opciones.EstadoAsistencia': {tokenchange: this.dispatch}
                , '#opciones.EstadoBeneficiario': {tokenchange: this.dispatch}
                , '#opciones.EstadoCivil': {tokenchange: this.dispatch}
                , '#opciones.EstadoEntidad': {tokenchange: this.dispatch}
                , '#opciones.EvalEduNelsonOrtiz': {tokenchange: this.dispatch}
                , '#opciones.Gestion': {tokenchange: this.dispatch}
                , '#opciones.Idioma': {tokenchange: this.dispatch}
                , '#opciones.Lugar': {tokenchange: this.dispatch}
                , '#opciones.MetodoPlanificacionFamiliar': {tokenchange: this.dispatch}
                , '#opciones.Ocupacion': {tokenchange: this.dispatch}
                , '#opciones.OtrosProgramas': {tokenchange: this.dispatch}
                , '#opciones.ParametrosGenerales': {tokenchange: this.dispatch}
                , '#opciones.PrivilegiosUsuario': {tokenchange: this.dispatch}
                , '#opciones.Religion': {tokenchange: this.dispatch}
                , '#opciones.ServicioBasico': {tokenchange: this.dispatch}
                , '#opciones.SubAreaActividad': {tokenchange: this.dispatch}
                , '#opciones.TipoActividad': {tokenchange: this.dispatch}
                , '#opciones.TipoActor': {tokenchange: this.dispatch}
                , '#opciones.TipoCasa': {tokenchange: this.dispatch}
                , '#opciones.TipoCocina': {tokenchange: this.dispatch}
                , '#opciones.TipoConsulta': {tokenchange: this.dispatch}
                , '#opciones.TipoDonante': {tokenchange: this.dispatch}
                , '#opciones.TipoEntidad': {tokenchange: this.dispatch}
                , '#opciones.TipoEventoVital': {tokenchange: this.dispatch}
                , '#opciones.TipoIdentificacion': {tokenchange: this.dispatch}
                , '#opciones.TipoLugar': {tokenchange: this.dispatch}
                , '#opciones.TipoParentesco': {tokenchange: this.dispatch}
                , '#opciones.TipoProblematica': {tokenchange: this.dispatch}
                , '#opciones.TipoUsuario': {tokenchange: this.dispatch}
                , '#opciones.UnidadEducativa': {tokenchange: this.dispatch}
                , '#opciones.Vacuna': {tokenchange: this.dispatch}
                , '#opciones.EdadesBeneficiario': {tokenchange: this.dispatch}
                , '#beneficiario.Beneficiario': {tokenchange: this.dispatch}
                , '#beneficiario.BeneficiarioTelefono': {tokenchange: this.dispatch}
                , '#beneficiario.BeneficiarioEstadoCivil': {tokenchange: this.dispatch}
                , '#beneficiario.BeneficiarioOcupacion': {tokenchange: this.dispatch}
                , '#beneficiario.BeneficiarioTrabajo': {tokenchange: this.dispatch}
                , '#familia.Familia': {tokenchange: this.dispatch}
                , '#actividad.Actividad': {tokenchange: this.dispatch}
                , '#usuario.Usuario': {tokenchange: this.dispatch}
                , '#entidad.Entidad': {tokenchange: this.dispatch}
                , '#reportes.Biblioteca': {tokenchange: this.dispatch}
                , '#participante.Participante': {tokenchange: this.dispatch}
                , '#participante.ParticipanteTelefono': {tokenchange: this.dispatch}
                , '#participante.ParticipanteEstadoCivil': {tokenchange: this.dispatch}
                , '#participante.ParticipanteOcupacion': {tokenchange: this.dispatch}
                , '#participante.ParticipanteTrabajo': {tokenchange: this.dispatch}
            },
            component: {
                'menu[xtype=layout.menu] menuitem': {
                    click: this.addHistory
                }
            },
            global: {
                //aftervalidateloggedin: this.setupApplication
                beforeviewportrender: this.setupApplication
            },
            store: {
                /*'#usuario.UsuarioPrivilegio': {
                    load: this.cargaMenu
                }*/
            },
            proxy: {
                '#basejson': {
                    requestcomplete: this.handleRESTResponse
                }
            }
        });
    },
    
    
    cargaMenu: function (store, records, successful, eOpts) {
        if (successful)
        {
            if (sisscsj.app.globals.globalMenuCargado === false)
            {
                var me = this,
                        west = me.getWestRegion(),
                        menu = Ext.widget('layout.menu');

                west.add(menu);

                sisscsj.app.globals.globalMenuCargado = true;
                sisscsj.app.globals.globalPrivilegiosCargados = true;

                Ext.getBody().unmask();

                Ext.globalEvents.fireEvent('beforeviewportrender');
            }
            else
            {
                return;
            }
        }
        else
        {
            Ext.Msg.alert('Atenci&oacute;n', 'Error al cargar privilegios. Por favor intente nuevamente.');
            return;
        }
    },
    
    
    setupApplication: function() {
        var me = this;
        // create the viewport, effectively creating the view for our application
        Ext.create('sisscsj.view.Viewport');
        // init Ext.util.History on app launch; if there is a hash in the url,
        // our controller will load the appropriate content
        Ext.util.History.init(function() {
            var hash = document.location.hash;
            me.fireEvent('tokenchange', hash.replace('#', ''));
        });
        // add change handler for Ext.util.History; when a change in the token
        // occurs, this will fire our controller's event to load the appropriate content
        Ext.util.History.on('change', function(token) {
            me.fireEvent('tokenchange', token);
        });
    },
            
 
    addHistory: function( item, e, opts ) {
        var me = this,
            token = item.itemId;
        Ext.util.History.add( token );
        me.fireEvent( 'tokenchange', token );
    },


    dispatch: function( token ) {
        var me = this,
            config;
        // switch on token to determine which content to create
        switch( token ) {

            case 'monitoreoactor/MonitoreoActor':
                config = {
                    xtype: 'monitoreoactor.monitoreoactor.lista',
                    title: 'Administración de Monitoreos de Actor',
                    iconCls: 'icon_color',
                    store: Ext.create( 'sisscsj.store.monitoreoactor.MonitoreoActor', {
                        pageSize: 10
                    })
                };
                break;


            case 'monitoreoactor/CriterioMonitoreoActor':
                config = {
                    xtype: 'opciones.criteriomonitoreoactor.lista',
                    title: 'Administración de Criterios de Monitoreo de Actor',
                    iconCls: 'icon_color',
                    store: Ext.create( 'sisscsj.store.opciones.CriterioMonitoreoActor', {
                        pageSize: 10
                    })
                };
                break;


            case 'monitoreoactor/CompetenciaMonitoreoActor':
                config = {
                    xtype: 'opciones.competenciamonitoreoactor.lista',
                    title: 'Administración de Competencias de Actor',
                    iconCls: 'icon_color',
                    store: Ext.create( 'sisscsj.store.opciones.CompetenciaMonitoreoActor', {
                        pageSize: 10
                    })
                };
                break;


            case 'monitoreoactor/TipoMonitoreoActor':
                config = {
                    xtype: 'opciones.tipomonitoreoactor.lista',
                    title: 'Administración de Monitoreos de Actor',
                    iconCls: 'icon_color',
                    store: Ext.create( 'sisscsj.store.opciones.TipoMonitoreoActor', {
                        pageSize: 10
                    })
                };
                break;


            case 'monitoreopc/MonitoreoPc':
                config = {
                    xtype: 'monitoreopc.monitoreopc.lista',
                    title: 'Administración de Monitoreos de Punto Comunitario',
                    iconCls: 'icon_color',
                    store: Ext.create( 'sisscsj.store.monitoreopc.MonitoreoPc', {
                        pageSize: 10
                    })
                };
                break;


            case 'monitoreopc/AmbitoMonitoreoPc':
                config = {
                    xtype: 'opciones.ambitomonitoreopc.lista',
                    title: 'Administración de Ámbitos para Monitoreo de Punto Comunitario',
                    iconCls: 'icon_color',
                    store: Ext.create( 'sisscsj.store.opciones.AmbitoMonitoreoPc', {
                        pageSize: 10
                    })
                };
                break;


            case 'monitoreopc/CaracteristicaMonitoreoPc':
                config = {
                    xtype: 'opciones.caracteristicamonitoreopc.lista',
                    title: 'Administración de Características para Monitoreo de Punto Comunitario',
                    iconCls: 'icon_color',
                    store: Ext.create( 'sisscsj.store.opciones.CaracteristicaMonitoreoPc', {
                        pageSize: 10
                    })
                };
                break;


            case 'proyectos/actividades':
                config = {
                    xtype: 'actividad_proyecto.lista',
                    title: 'Administración de Actividades de Proyecto',
                    iconCls: 'icon_color',
                    store: Ext.create( 'sisscsj.store.actividad_proyecto.ActividadProyecto', {
                        pageSize: 10
                    })
                };
                break;


            case 'opciones/formacion':
                config = {
                    xtype: 'opciones.formacion.lista',
                    title: 'Administración de Formación',
                    iconCls: 'icon_color',
                    store: Ext.create( 'sisscsj.store.opciones.Formacion', {
                        pageSize: 10
                    })
                };
                break;



            case 'proyectos/participantes':
                config = {
                    xtype: 'participante.lista',
                    title: 'Administración de Participantes',
                    iconCls: 'icon_color',
                    store: Ext.create( 'sisscsj.store.participante.Participante', {
                        pageSize: 10
                    })
                };
                break;



            case 'opciones/Turno':
                config = {
                    xtype: 'opciones.turno.lista',
                    title: 'Administración de Turnos',
                    iconCls: 'icon_color',
                    store: Ext.create( 'sisscsj.store.opciones.Turno', {
                        pageSize: 10
                    })
                };
                break;


            case 'opciones/Nivel':
                config = {
                    xtype: 'opciones.nivel.lista',
                    title: 'Administración de Niveles',
                    iconCls: 'icon_color',
                    store: Ext.create( 'sisscsj.store.opciones.Nivel', {
                        pageSize: 10
                    })
                };
                break;


            case 'opciones/Curso':
                config = {
                    xtype: 'opciones.curso.lista',
                    title: 'Administración de Cursos',
                    iconCls: 'icon_color',
                    store: Ext.create( 'sisscsj.store.opciones.Curso', {
                        pageSize: 10
                    })
                };
                break;


            case 'opciones/actividadFavorita':
                config = {
                    xtype: 'opciones.actividadfavorita.lista',
                    title: 'Administración de Actividades Favoritas',
                    iconCls: 'icon_color',
                    store: Ext.create( 'sisscsj.store.opciones.ActividadFavorita', {
                        pageSize: 10
                    })
                };
                break;


            case 'opciones/areaActividad':
                config = {
                    xtype: 'opciones.areaactividad.lista',
                    title: 'Administración de Area de Actividad',
                    iconCls: 'icon_color',
                    store: Ext.create( 'sisscsj.store.opciones.AreaActividad', {
                        pageSize: 10
                    })
                };
                break;
                
                
            case 'opciones/subAreaActividad':
                config = {
                    xtype: 'opciones.subareaactividad.lista',
                    title: 'Administración de Sub-Áreas de Actividad',
                    iconCls: 'icon_color',
                    store: Ext.create( 'sisscsj.store.opciones.SubAreaActividad', {
                        pageSize: 10
                    })
                };
                break;



            case 'opciones/areaConocimientoBiblioteca':
                config = {
                    xtype: 'opciones.areaconocimientobiblioteca.lista',
                    title: 'Administración de Area de Conocimiento en Biblioteca',
                    iconCls: 'icon_color',
                    store: Ext.create( 'sisscsj.store.opciones.AreaConocimientoBiblioteca', {
                        pageSize: 10
                    })
                };
                break;


            case 'beneficiario/Beneficiario':
                config = {
                    xtype: 'beneficiario.lista',
                    title: 'Administración de Beneficiarios',
                    iconCls: 'icon_color',
                    store: Ext.create( 'sisscsj.store.beneficiario.Beneficiario', {
                        pageSize: 10
                    })
                };
                break;
                
                
            case 'familia/Familia':
                config = {
                    xtype: 'familia.lista',
                    title: 'Administración de Familias',
                    iconCls: 'icon_familia',
                    store: Ext.create( 'sisscsj.store.familia.Familia', {
                        pageSize: 10
                    })
                };
                break;


            case 'opciones/beneficiarioTipo':
                config = {
                    xtype: 'opciones.beneficiariotipo.lista',
                    title: 'Administración de Tipos de Beneficiario',
                    iconCls: 'icon_color',
                    store: Ext.create( 'sisscsj.store.opciones.BeneficiarioTipo', {
                        pageSize: 10
                    })
                };
                break;
                
                
             case 'opciones/edadesBeneficiario':
                config = {
                    xtype: 'opciones.edadesbeneficiario.lista',
                    title: 'Administración de Edades de Beneficiario',
                    iconCls: 'icon_color',
                    store: Ext.create( 'sisscsj.store.opciones.EdadesBeneficiario', {
                        pageSize: 10
                    })
                };
                break;               


            case 'opciones/departamento':
                config = {
                    xtype: 'opciones.departamento.lista',
                    title: 'Administración de Departamentos',
                    iconCls: 'icon_color',
                    store: Ext.create( 'sisscsj.store.opciones.Departamento', {
                        pageSize: 10
                    })
                };
                break;

            case 'opciones/provincia':
                config = {
                    xtype: 'opciones.provincia.lista',
                    title: 'Administración de Provincias',
                    iconCls: 'icon_color',
                    store: Ext.create( 'sisscsj.store.opciones.Provincia', {
                        pageSize: 10
                    })
                };
                break;


            case 'opciones/localidad':
                config = {
                    xtype: 'opciones.localidad.lista',
                    title: 'Administración de Localidades',
                    iconCls: 'icon_color',
                    store: Ext.create( 'sisscsj.store.opciones.Localidad', {
                        pageSize: 10
                    })
                };
                break;


            case 'opciones/zona':
                config = {
                    xtype: 'opciones.zona.lista',
                    title: 'Administración de Zonas',
                    iconCls: 'icon_color',
                    store: Ext.create( 'sisscsj.store.opciones.Zona', {
                        pageSize: 10
                    })
                };
                break;


            case 'opciones/sector':
                config = {
                    xtype: 'opciones.sector.lista',
                    title: 'Administración de Sectores',
                    iconCls: 'icon_color',
                    store: Ext.create( 'sisscsj.store.opciones.Sector', {
                        pageSize: 10
                    })
                };
                break;


            case 'opciones/diagnostico':
                config = {
                    xtype: 'opciones.diagnostico.lista',
                    title: 'Administración de Diagnósticos',
                    iconCls: 'icon_color',
                    store: Ext.create( 'sisscsj.store.opciones.Diagnostico', {
                        pageSize: 10
                    })
                };
                break;


            case 'opciones/enfermedadComun':
                config = {
                    xtype: 'opciones.enfermedadcomun.lista',
                    title: 'Administración de Enfermedades Comunes',
                    iconCls: 'icon_color',
                    store: Ext.create( 'sisscsj.store.opciones.EnfermedadComun', {
                        pageSize: 10
                    })
                };
                break;


            case 'opciones/entidadSalud':
                config = {
                    xtype: 'opciones.entidadsalud.lista',
                    title: 'Administración de Entidades de Salud',
                    iconCls: 'icon_color',
                    store: Ext.create( 'sisscsj.store.opciones.EntidadSalud', {
                        pageSize: 10
                    })
                };
                break;


            case 'opciones/estadoAsistencia':
                config = {
                    xtype: 'opciones.estadoasistencia.lista',
                    title: 'Administración de Estados de Asistencia',
                    iconCls: 'icon_color',
                    store: Ext.create( 'sisscsj.store.opciones.EstadoAsistencia', {
                        pageSize: 10
                    })
                };
                break;


            case 'opciones/estadoBeneficiario':
                config = {
                    xtype: 'opciones.estadobeneficiario.lista',
                    title: 'Administración de Estados de Beneficiario',
                    iconCls: 'icon_color',
                    store: Ext.create( 'sisscsj.store.opciones.EstadoBeneficiario', {
                        pageSize: 10
                    })
                };
                break;


            case 'opciones/estadoCivil':
                config = {
                    xtype: 'opciones.estadocivil.lista',
                    title: 'Administración de Estado Civil',
                    iconCls: 'icon_color',
                    store: Ext.create( 'sisscsj.store.opciones.EstadoCivil', {
                        pageSize: 10
                    })
                };
                break;


            case 'opciones/estadoEntidad':
                config = {
                    xtype: 'opciones.estadoentidad.lista',
                    title: 'Administración de Estados de Entidad',
                    iconCls: 'icon_color',
                    store: Ext.create( 'sisscsj.store.opciones.EstadoEntidad', {
                        pageSize: 10
                    })
                };
                break;


            case 'opciones/evaleduNelsonOrtiz':
                config = {
                    xtype: 'opciones.evaledunelsonortiz.lista',
                    title: 'Administración de Evaluaciones Nelson Ortiz',
                    iconCls: 'icon_color',
                    store: Ext.create( 'sisscsj.store.opciones.EvalEduNelsonOrtiz', {
                        pageSize: 10
                    })
                };
                break;


            case 'opciones/gestion':
                config = {
                    xtype: 'opciones.gestion.lista',
                    title: 'Administración de Gestión',
                    iconCls: 'icon_color',
                    store: Ext.create( 'sisscsj.store.opciones.Gestion', {
                        pageSize: 10
                    })
                };
                break;


            case 'opciones/idioma':
                config = {
                    xtype: 'opciones.idioma.lista',
                    title: 'Administración de Idiomas',
                    iconCls: 'icon_color',
                    store: Ext.create( 'sisscsj.store.opciones.Idioma', {
                        pageSize: 10
                    })
                };
                break;


            case 'opciones/metodoPlanificacionFamiliar':
                config = {
                    xtype: 'opciones.metodoplanificacionfamiliar.lista',
                    title: 'Administración de Métodos de Planificacion Familiar',
                    iconCls: 'icon_color',
                    store: Ext.create( 'sisscsj.store.opciones.MetodoPlanificacionFamiliar', {
                        pageSize: 10
                    })
                };
                break;


            case 'opciones/ocupacion':
                config = {
                    xtype: 'opciones.ocupacion.lista',
                    title: 'Administración de Ocupaciones',
                    iconCls: 'icon_color',
                    store: Ext.create( 'sisscsj.store.opciones.Ocupacion', {
                        pageSize: 10
                    })
                };
                break;


            case 'opciones/otrosProgramas':
                config = {
                    xtype: 'opciones.otrosprogramas.lista',
                    title: 'Administración de Otros Programas',
                    iconCls: 'icon_color',
                    store: Ext.create( 'sisscsj.store.opciones.OtrosProgramas', {
                        pageSize: 10
                    })
                };
                break;


            case 'opciones/parametrosGenerales':
                config = {
                    xtype: 'opciones.parametrosgenerales.lista',
                    title: 'Administración de Parámetros Generales (SISTEMA)',
                    iconCls: 'icon_color',
                    store: Ext.create( 'sisscsj.store.opciones.ParametrosGenerales', {
                        pageSize: 10
                    })
                };
                break;


            case 'opciones/privilegiosUsuario':
                config = {
                    xtype: 'opciones.privilegiosusuario.lista',
                    title: 'Administración de Privilegios de Usuario (SISTEMA)',
                    iconCls: 'icon_color',
                    store: Ext.create( 'sisscsj.store.opciones.PrivilegiosUsuario', {
                        pageSize: 10
                    })
                };
                break;


            case 'opciones/religion':
                config = {
                    xtype: 'opciones.religion.lista',
                    title: 'Administración de Religiones',
                    iconCls: 'icon_color',
                    store: Ext.create( 'sisscsj.store.opciones.Religion', {
                        pageSize: 10
                    })
                };
                break;


            case 'opciones/servicioBasico':
                config = {
                    xtype: 'opciones.serviciobasico.lista',
                    title: 'Administración de Servicios Básicos',
                    iconCls: 'icon_color',
                    store: Ext.create( 'sisscsj.store.opciones.ServicioBasico', {
                        pageSize: 10
                    })
                };
                break;


            case 'opciones/tipoActividad':
                config = {
                    xtype: 'opciones.tipoactividad.lista',
                    title: 'Administración de Tipos de Actividad',
                    iconCls: 'icon_color',
                    store: Ext.create( 'sisscsj.store.opciones.TipoActividad', {
                        pageSize: 10
                    })
                };
                break;


            case 'actividad/Actividad':
                config = {
                    xtype: 'actividad.lista',
                    title: 'Administración de Actividades',
                    iconCls: 'icon_color',
                    store: Ext.create( 'sisscsj.store.actividad.Actividad', {
                        pageSize: 10
                    })
                };
                break;
                
                
            case 'asistencia/Asistencia':
                config = {
                    xtype: 'asistencia.lista',
                    title: 'Administración de Asistencia',
                    iconCls: 'icon_color',
                    store: Ext.create( 'sisscsj.store.asistencia.Asistencia', {
                        pageSize: 10
                    })
                };
                break;                



            case 'opciones/tipoActor':
                config = {
                    xtype: 'opciones.tipoactor.lista',
                    title: 'Administración de Tipos de Actor',
                    iconCls: 'icon_color',
                    store: Ext.create( 'sisscsj.store.opciones.TipoActor', {
                        pageSize: 10
                    })
                };
                break;


            case 'opciones/tipoCasa':
                config = {
                    xtype: 'opciones.tipocasa.lista',
                    title: 'Administración de Tipos de Casa',
                    iconCls: 'icon_color',
                    store: Ext.create( 'sisscsj.store.opciones.TipoCasa', {
                        pageSize: 10
                    })
                };
                break;


            case 'opciones/tipoCocina':
                config = {
                    xtype: 'opciones.tipococina.lista',
                    title: 'Administración de Tipos de Cocina',
                    iconCls: 'icon_color',
                    store: Ext.create( 'sisscsj.store.opciones.TipoCocina', {
                        pageSize: 10
                    })
                };
                break;


            case 'opciones/tipoConsulta':
                config = {
                    xtype: 'opciones.tipoconsulta.lista',
                    title: 'Administración de Tipos de Consulta',
                    iconCls: 'icon_color',
                    store: Ext.create( 'sisscsj.store.opciones.TipoConsulta', {
                        pageSize: 10
                    })
                };
                break;


            case 'opciones/tipoDonante':
                config = {
                    xtype: 'opciones.tipodonante.lista',
                    title: 'Administración de Tipo de Donante',
                    iconCls: 'icon_color',
                    store: Ext.create( 'sisscsj.store.opciones.TipoDonante', {
                        pageSize: 10
                    })
                };
                break;
                
                
            case 'opciones/Donante':
                config = {
                    xtype: 'opciones.donante.lista',
                    title: 'Administración de Donantes',
                    iconCls: 'icon_color',
                    store: Ext.create( 'sisscsj.store.opciones.Donante', {
                        pageSize: 10
                    })
                };
                break;



            case 'opciones/tipoEntidad':
                config = {
                    xtype: 'opciones.tipoentidad.lista',
                    title: 'Administración de Tipos de Entidad',
                    iconCls: 'icon_color',
                    store: Ext.create( 'sisscsj.store.opciones.TipoEntidad', {
                        pageSize: 10
                    })
                };
                break;


            case 'opciones/tipoEventoVital':
                config = {
                    xtype: 'opciones.tipoeventovital.lista',
                    title: 'Administración de Tipos de Evento Vital',
                    iconCls: 'icon_color',
                    store: Ext.create( 'sisscsj.store.opciones.TipoEventoVital', {
                        pageSize: 10
                    })
                };
                break;


            case 'opciones/tipoIdentificacion':
                config = {
                    xtype: 'opciones.tipoidentificacion.lista',
                    title: 'Administración de Tipos de Identificacion',
                    iconCls: 'icon_color',
                    store: Ext.create( 'sisscsj.store.opciones.TipoIdentificacion', {
                        pageSize: 10
                    })
                };
                break;


            case 'opciones/Lugar':
                config = {
                    xtype: 'opciones.lugar.lista',
                    title: 'Administración de Lugares',
                    iconCls: 'icon_color',
                    store: Ext.create( 'sisscsj.store.opciones.Lugar', {
                        pageSize: 10
                    })
                };
                break;



            case 'opciones/tipoLugar':
                config = {
                    xtype: 'opciones.tipolugar.lista',
                    title: 'Administración de Tipos de Lugar',
                    iconCls: 'icon_color',
                    store: Ext.create( 'sisscsj.store.opciones.TipoLugar', {
                        pageSize: 10
                    })
                };
                break;


            case 'opciones/tipoParentesco':
                config = {
                    xtype: 'opciones.tipoparentesco.lista',
                    title: 'Administración de Tipos de Parentesco',
                    iconCls: 'icon_color',
                    store: Ext.create( 'sisscsj.store.opciones.TipoParentesco', {
                        pageSize: 10
                    })
                };
                break;


            case 'opciones/tipoProblematica':
                config = {
                    xtype: 'opciones.tipoproblematica.lista',
                    title: 'Administración de Tipos de Problematica',
                    iconCls: 'icon_color',
                    store: Ext.create( 'sisscsj.store.opciones.TipoProblematica', {
                        pageSize: 10
                    })
                };
                break;


            case 'opciones/tipoUsuario':
                config = {
                    xtype: 'opciones.tipousuario.lista',
                    title: 'Administración de Tipos de Usuario (SISTEMA)',
                    iconCls: 'icon_color',
                    store: Ext.create( 'sisscsj.store.opciones.TipoUsuario', {
                        pageSize: 10
                    })
                };
                break;


            case 'opciones/unidadEducativa':
                config = {
                    xtype: 'opciones.unidadeducativa.lista',
                    title: 'Administración de Unidades Educativas',
                    iconCls: 'icon_color',
                    store: Ext.create( 'sisscsj.store.opciones.UnidadEducativa', {
                        pageSize: 10
                    })
                };
                break;


            case 'opciones/vacuna':
                config = {
                    xtype: 'opciones.vacuna.lista',
                    title: 'Administración de Vacunas',
                    iconCls: 'icon_color',
                    store: Ext.create( 'sisscsj.store.opciones.Vacuna', {
                        pageSize: 10
                    })
                };
                break;
                
                
                
            case 'usuario/Usuario':
                config = {
                    xtype: 'usuario.lista',
                    title: 'Administración de Usuarios',
                    iconCls: 'icon_color',
                    store: Ext.create( 'sisscsj.store.usuario.Usuario', {
                        pageSize: 10
                    })
                };
                break;                
                
                
            case 'entidad/Entidad':
                config = {
                    xtype: 'entidad.lista',
                    title: 'Administración de Entidades',
                    iconCls: 'icon_color',
                    store: Ext.create( 'sisscsj.store.entidad.Entidad', {
                        pageSize: 10
                    })
                };
                break;                
                
                
                
            case 'reportes/reporteBiblioteca':
                config = {
                    xtype: 'reportes.biblioteca.window',
                    title: 'Parámetro de Reporte de Biblioteca'
                };
                //Ext.create('sisscsj.view.reportes.biblioteca.Window').show();
                break;       
            
            
            
            case 'gestion/Gestion':
                config = {
                    xtype: 'gestion.lista',
                    title: 'Administración de Gestiones',
                    iconCls: 'icon_color',
                    store: Ext.create( 'sisscsj.store.gestion.Gestion', {
                        pageSize: 10
                    })
                };
                break;        
            
            
                
                
            /*case 'reportes/reporteFichaSocialFamiliar':
                config = {
                    xtype: '',
                    title: 'Reporte: Ficha Social Familiar',
                    iconCls: 'icon_color'
                };
                break;*/
                
                
                
            
            default: 
                config = {
                    xtype: 'layout.landing'
                };
                break;
        }
        me.updateCenterRegion( config );
    },


    updateCenterRegion: function( config ) {
        var me = this,
            center = me.getCenterRegion();

        // remove all existing content
        center.removeAll( true );
        // add new content
        center.add( config );
    },
            

    handleRESTResponse: function(request, success) {
        var me = this,
            rawData = request.proxy.reader.rawData;
        // in all cases, let's hide the body mask
        Ext.getBody().unmask();
        
        // if proxy success
        if (success) {
            // if operation success
            if (request.operation.wasSuccessful()) {

                if ( (typeof rawData.meta) !== "undefined" )
                {
                    Ext.create('widget.uxNotification', {
                        title: 'Notificación',
                        position: 'tr',
                        manager: 'sisscsjmanager',
                        iconCls: 'ux-notification-icon-information',
                        autoCloseDelay: 4000,
                        spacing: 25,
                        padding: 10,
                        html: rawData.meta.msg
                    }).show();
                    
                    if ( (typeof rawData.meta.sesion) !== "undefined" )
                    {
                        if ( rawData.meta.sesion === "false" )
                        {
                            window.location.href = './index.php';
                        }
                    }
                }
                
            }
            // if operation failure
            else {

                if ( (typeof rawData.meta) !== "undefined")
                {
                    Ext.create('widget.uxNotification', {
                        title: 'Notificación',
                        position: 'tr',
                        manager: 'sisscsjmanager',
                        iconCls: 'ux-notification-icon-information',
                        autoCloseDelay: 4000,
                        spacing: 25,
                        padding: 10,
                        html: rawData.meta.msg
                    }).show();
                }
            }
        }
        // otherwise, major failure...
        else {
            Ext.create('widget.uxNotification', {
                        title: 'Error',
                        position: 'tr',
                        manager: 'sisscsjmanager',
                        iconCls: 'ux-notification-icon-information',
                        autoCloseDelay: 4000,
                        spacing: 25,
                        padding: 10,
                        html: 'Error al conectar al servidor.'
                    }).show();
        }
    }
});


/*window.onbeforeunload = function() {
    return "¿Esta seguro que desea salir del sistema?. Cualquier dato que no guard&oacute; se perder&aacute;.";
}.bind(this);*/