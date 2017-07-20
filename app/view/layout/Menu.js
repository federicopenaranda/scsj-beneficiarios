Ext.define('sisscsj.view.layout.Menu', {
    extend: 'Ext.menu.Menu',
    alias: 'widget.layout.menu',
    floating: false,
    initComponent: function() {
        var me = this;
        
        var storePrivilegios = Ext.data.StoreManager.lookup('privilegio.Privilegio');
        storePrivilegios.load();
        
        /*var storePrivilegios = Ext.create('Ext.data.Store', {
            fields: ['nombre', 'valor'],
            data : [
                {"nombre":"menu.opciones", "valor": (sisscsj.app.globals.globalTipoUsuario === 'admin') ? false : true },
                {"nombre":"menu.gestiones", "valor": (sisscsj.app.globals.globalTipoUsuario === 'admin') ? false : true },
                {"nombre":"menu.actividades", "valor": (sisscsj.app.globals.globalTipoUsuario === 'admin') ? false : true },
                {"nombre":"menu.asistencia", "valor": (sisscsj.app.globals.globalTipoUsuario === 'admin') ? false : true },
                {"nombre":"menu.usuarios", "valor": (sisscsj.app.globals.globalTipoUsuario === 'admin') ? false : true },
                {"nombre":"menu.entidades", "valor": (sisscsj.app.globals.globalTipoUsuario === 'admin') ? false : true },
                {"nombre":"menu.reportes", "valor": (sisscsj.app.globals.globalTipoUsuario === 'admin') ? false : true },
                {"nombre":"menu.beneficiarios", "valor": false }
            ]
        });*/
        
        Ext.applyIf(me, {
            items: [
                {
                    text: 'Opciones',
                    itemId: 'opciones',
                    iconCls: 'icon_gear',
                    //hidden: me.privilegio('menu.opciones'),
                    menu: [
                        {
                            text: 'Módulo: Actividades',
                            itemId: 'modulo/Actividades',
                            iconCls: 'icon_gear',
                            menu: [
                                {
                                    text: 'Adm. Actividad Favorita',
                                    itemId: 'opciones/actividadFavorita',
                                    iconCls: 'icon_gear'
                                },
                                {
                                    text: 'Adm. Área de Actividad',
                                    itemId: 'opciones/areaActividad',
                                    iconCls: 'icon_gear'
                                },
                                {
                                    text: 'Adm. Sub Áreas de Actividad',
                                    itemId: 'opciones/subAreaActividad',
                                    iconCls: 'icon_gear'
                                },
                                {
                                    text: 'Adm. Tipo de Actividad',
                                    itemId: 'opciones/tipoActividad',
                                    iconCls: 'icon_gear'
                                },
                                {
                                    text: 'Adm. Tipo de Lugar',
                                    itemId: 'opciones/tipoLugar',
                                    iconCls: 'icon_gear'
                                },
                                {
                                    text: 'Adm. Lugares',
                                    itemId: 'opciones/Lugar',
                                    iconCls: 'icon_gear'
                                }
                            ]
                        },
                        {
                            text: 'Módulo: Asistencia',
                            itemId: 'modulo/Asistencia',
                            iconCls: 'icon_gear',
                            menu: [
                                {
                                    text: 'Adm. Estados de Asistencia',
                                    itemId: 'opciones/estadoAsistencia',
                                    iconCls: 'icon_gear'
                                }
                            ]
                        },
                        {
                            text: 'Módulo: Atención Médica',
                            itemId: 'modulo/AtencionMedica',
                            iconCls: 'icon_gear',
                            menu: [
                                {
                                    text: 'Adm. Diagnósticos',
                                    itemId: 'opciones/diagnostico',
                                    iconCls: 'icon_gear'
                                },
                                {
                                    text: 'Adm. Enfermedad Común',
                                    itemId: 'opciones/enfermedadComun',
                                    iconCls: 'icon_gear'
                                }
                            ]
                        },
                        {
                            text: 'Módulo: Beneficiarios',
                            itemId: 'modulo/Beneficiarios',
                            iconCls: 'icon_gear',
                            menu: [
                                {
                                    text: 'Adm. Tipo de Beneficiario',
                                    itemId: 'opciones/beneficiarioTipo',
                                    iconCls: 'icon_gear'
                                },
                                {
                                    text: 'Adm. Tipo de Actor',
                                    itemId: 'opciones/tipoActor',
                                    iconCls: 'icon_gear'
                                },
                                {
                                    text: 'Adm. Entidad de Salud',
                                    itemId: 'opciones/entidadSalud',
                                    iconCls: 'icon_gear'
                                },
                                {
                                    text: 'Adm. Estado Beneficiario',
                                    itemId: 'opciones/estadoBeneficiario',
                                    iconCls: 'icon_gear'
                                },
                                {
                                    text: 'Adm. Estado Civil',
                                    itemId: 'opciones/estadoCivil',
                                    iconCls: 'icon_gear'
                                },
                                {
                                    text: 'Adm. Idioma',
                                    itemId: 'opciones/idioma',
                                    iconCls: 'icon_gear'
                                },
                                {
                                    text: 'Adm. Ocupaciones',
                                    itemId: 'opciones/ocupacion',
                                    iconCls: 'icon_gear'
                                },
                                {
                                    text: 'Adm. Otros Programas',
                                    itemId: 'opciones/otrosProgramas',
                                    iconCls: 'icon_gear'
                                },
                                {
                                    text: 'Adm. Religión',
                                    itemId: 'opciones/religion',
                                    iconCls: 'icon_gear'
                                },
                                {
                                    text: 'Adm. Tipo de Donante',
                                    itemId: 'opciones/tipoDonante',
                                    iconCls: 'icon_gear'
                                },
                                {
                                    text: 'Adm. Donantes',
                                    itemId: 'opciones/Donante',
                                    iconCls: 'icon_gear'
                                },
                                {
                                    text: 'Adm. Tipo de Identificación',
                                    itemId: 'opciones/tipoIdentificacion',
                                    iconCls: 'icon_gear'
                                },
                                {
                                    text: 'Adm. Tipo de Parentesco',
                                    itemId: 'opciones/tipoParentesco',
                                    iconCls: 'icon_gear'
                                },
                                {
                                    text: 'Adm. Unidades Educativas',
                                    itemId: 'opciones/unidadEducativa',
                                    iconCls: 'icon_gear'
                                },
                                {
                                    text: 'Adm. Edades Beneficiario',
                                    itemId: 'opciones/edadesBeneficiario',
                                    iconCls: 'icon_gear'
                                },
                                {
                                    text: 'Adm. Cursos',
                                    itemId: 'opciones/Curso',
                                    iconCls: 'icon_gear'
                                },
                                {
                                    text: 'Adm. Nivel',
                                    itemId: 'opciones/Nivel',
                                    iconCls: 'icon_gear'
                                },
                                {
                                    text: 'Adm. Turno',
                                    itemId: 'opciones/Turno',
                                    iconCls: 'icon_gear'
                                },
                                {
                                    text: 'Adm. Formación',
                                    itemId: 'opciones/formacion',
                                    iconCls: 'icon_gear'
                                }
                            ]
                        },
                        {
                            text: 'Módulo: Biblioteca',
                            itemId: 'modulo/Biblioteca',
                            iconCls: 'icon_gear',
                            menu: [
                                {
                                    text: 'Adm. Área de Conocimiento',
                                    itemId: 'opciones/areaConocimientoBiblioteca',
                                    iconCls: 'icon_gear'
                                }
                            ]
                        },
                        {
                            text: 'Módulo: Enfermería',
                            itemId: 'modulo/Enfermeria',
                            iconCls: 'icon_gear',
                            menu: [
                                {
                                    text: 'Adm. Vacunas',
                                    itemId: 'opciones/vacuna',
                                    iconCls: 'icon_gear'
                                }
                            ]
                        },
                        {
                            text: 'Módulo: Entidad',
                            itemId: 'modulo/Entidad',
                            iconCls: 'icon_gear',
                            menu: [
                                {
                                    text: 'Adm. Estado de Entidad',
                                    itemId: 'opciones/estadoEntidad',
                                    iconCls: 'icon_gear'
                                },
                                {
                                    text: 'Adm. Tipo de Entidad',
                                    itemId: 'opciones/tipoEntidad',
                                    iconCls: 'icon_gear'
                                }
                            ]
                        },
                        {
                            text: 'Módulo: Evaluaciones',
                            itemId: 'modulo/Evaluaciones',
                            iconCls: 'icon_gear',
                            menu: [
                                {
                                    text: 'Adm. Tipo de Consulta',
                                    itemId: 'opciones/tipoConsulta',
                                    iconCls: 'icon_gear'
                                },
                                {
                                    text: 'Adm. Tipo de Problemática',
                                    itemId: 'opciones/tipoProblematica',
                                    iconCls: 'icon_gear'
                                }
                            ]
                        },
                        {
                            text: 'Módulo: Familia',
                            itemId: 'modulo/Familia',
                            iconCls: 'icon_gear',
                            menu: [
                                {
                                    text: 'Adm. Métodos Planificación Familiar',
                                    itemId: 'opciones/metodoPlanificacionFamiliar',
                                    iconCls: 'icon_gear'
                                },
                                {
                                    text: 'Adm. Servicios Básicos',
                                    itemId: 'opciones/servicioBasico',
                                    iconCls: 'icon_gear'
                                },
                                {
                                    text: 'Adm. Tipo de Casa',
                                    itemId: 'opciones/tipoCasa',
                                    iconCls: 'icon_gear'
                                },
                                {
                                    text: 'Adm. Tipo de Cocina',
                                    itemId: 'opciones/tipoCocina',
                                    iconCls: 'icon_gear'
                                },
                                {
                                    text: 'Adm. Tipo de Evento Vital',
                                    itemId: 'opciones/tipoEventoVital',
                                    iconCls: 'icon_gear'
                                }
                            ]
                        },
                        {
                            text: 'Módulo: Localidad',
                            itemId: 'modulo/Localidad',
                            iconCls: 'icon_gear',
                            menu: [
                                {
                                    text: 'Adm. Departamentos',
                                    itemId: 'opciones/departamento',
                                    iconCls: 'icon_gear'
                                },
                                {
                                    text: 'Adm. Provincias',
                                    itemId: 'opciones/provincia',
                                    iconCls: 'icon_gear'
                                },
                                {
                                    text: 'Adm. Localidades',
                                    itemId: 'opciones/localidad',
                                    iconCls: 'icon_gear'
                                },
                                {
                                    text: 'Adm. Zonas',
                                    itemId: 'opciones/zona',
                                    iconCls: 'icon_gear'
                                },
                                {
                                    text: 'Adm. Sectores',
                                    itemId: 'opciones/sector',
                                    iconCls: 'icon_gear'
                                }
                            ]
                        },
                        {
                            text: 'Módulo: Sistema',
                            itemId: 'modulo/Sistema',
                            iconCls: 'icon_gear',
                            menu: [
                                {
                                    text: 'Adm. Parámetros Generales',
                                    itemId: 'opciones/parametrosGenerales',
                                    iconCls: 'icon_gear'
                                },
                                {
                                    text: 'Adm. Privilegios de Usuario',
                                    itemId: 'opciones/privilegiosUsuario',
                                    iconCls: 'icon_gear'
                                }
                            ]
                        },
                        {
                            text: 'Módulo: Usuarios',
                            itemId: 'modulo/Usuarios',
                            iconCls: 'icon_gear',
                            menu: [
                                {
                                    text: 'Adm. Tipos de Usuario',
                                    itemId: 'opciones/tipoUsuario',
                                    iconCls: 'icon_gear'
                                }
                            ]
                        }
                    ]
                },
                {
                    xtype: 'menuseparator'
                    //hidden: me.privilegio('menu.proyectos')
                },
                {
                    text: 'Proyectos',
                    itemId: 'proyectos',
                    iconCls: 'icon_familia',
                    //hidden: me.privilegio('menu.proyectos'),
                    menu: [
                        {
                            text: 'Adm. Participantes',
                            itemId: 'proyectos/participantes',
                            iconCls: 'icon_gear'
                        },
                        {
                            text: 'Adm. Actividades de Proyecto',
                            itemId: 'proyectos/actividades',
                            iconCls: 'icon_gear'
                        },
                        {
                            text: 'Adm. Monitoreo de Punto Comunitario',
                            itemId: 'monitoreo/puntoComunitario',
                            iconCls: 'icon_gear',
                            menu: [
                                {
                                    text: 'Adm. Características',
                                    itemId: 'monitoreopc/CaracteristicaMonitoreoPc',
                                    iconCls: 'icon_gear'
                                },
                                {
                                    text: 'Adm. Ámbitos',
                                    itemId: 'monitoreopc/AmbitoMonitoreoPc',
                                    iconCls: 'icon_gear'
                                },
                                {
                                    text: 'Adm. Monitoreos de Punto Comunitario',
                                    itemId: 'monitoreopc/MonitoreoPc',
                                    iconCls: 'icon_gear'
                                }
                            ]
                        },
                        {
                            text: 'Adm. Monitoreo de Actores',
                            itemId: 'monitoreo/Actores',
                            iconCls: 'icon_gear',
                            menu: [
                                {
                                    text: 'Adm. Tipo de Monitoreo de Actor',
                                    itemId: 'monitoreoactor/TipoMonitoreoActor',
                                    iconCls: 'icon_gear'
                                },
                                {
                                    text: 'Adm. Competencia de Monitoreo de Actor',
                                    itemId: 'monitoreoactor/CompetenciaMonitoreoActor',
                                    iconCls: 'icon_gear'
                                },
                                {
                                    text: 'Adm. Criterio de Monitoreo de Actor',
                                    itemId: 'monitoreoactor/CriterioMonitoreoActor',
                                    iconCls: 'icon_gear'
                                },
                                {
                                    text: 'Adm. Monitoreos de Actor',
                                    itemId: 'monitoreoactor/MonitoreoActor',
                                    iconCls: 'icon_gear'
                                }
                            ]
                        }
                    ]
                },
                {
                    xtype: 'menuseparator'
                    //hidden: me.privilegio('menu.gestiones')
                },
                {
                    text: 'Gestiones',
                    itemId: 'gestiones',
                    iconCls: 'icon_familia',
                    //hidden: me.privilegio('menu.gestiones'),
                    menu: [
                        {
                            text: 'Adm. Gesti&oacute;n',
                            itemId: 'gestion/Gestion',
                            iconCls: 'icon_familia'
                        }
                    ]
                },
                {
                    xtype: 'menuseparator'
                    //hidden: me.privilegio('menu.beneficiarios')
                },
                {
                    text: 'Beneficiarios',
                    //hidden: me.privilegio('menu.beneficiarios'),
                    itemId: 'beneficiarios',
                    iconCls: 'icon_user',
                    menu: [
                        {
                            text: 'Adm. Beneficiarios',
                            itemId: 'beneficiario/Beneficiario',
                            iconCls: 'icon_user'
                        }
                    ]
                },
                {
                    xtype: 'menuseparator'
                },
                {
                    text: 'Familias',
                    itemId: 'familias',
                    //hidden: me.privilegio('menu.familia'),
                    iconCls: 'icon_familia',
                    menu: [
                        {
                            text: 'Adm. Familias',
                            itemId: 'familia/Familia',
                            iconCls: 'icon_familia'
                        }
                    ]
                },
                {
                    xtype: 'menuseparator'
                    //hidden: me.privilegio('menu.actividades')
                },
                {
                    text: 'Actividades',
                    itemId: 'actividades',
                    //hidden: me.privilegio('menu.actividades'),
                    iconCls: 'icon_actividad',
                    menu: [
                        {
                            text: 'Adm. Actividades',
                            itemId: 'actividad/Actividad',
                            iconCls: 'icon_actividad'
                        }
                    ]
                },
                {
                    xtype: 'menuseparator'
                    //hidden: me.privilegio('menu.asistencia')
                },
                {
                    text: 'Asistencia',
                    itemId: 'asistencia',
                   // hidden: me.privilegio('menu.asistencia'),
                    iconCls: 'icon_category',
                    menu: [
                        {
                            text: 'Adm. Asistencia',
                            itemId: 'asistencia/Asistencia',
                            iconCls: 'icon_category'
                        }
                    ]
                },
                {
                    xtype: 'menuseparator'
                    //hidden: me.privilegio('menu.usuarios')
                },
                {
                    text: 'Usuarios',
                    itemId: 'usuario',
                    //hidden: me.privilegio('menu.usuarios'),
                    iconCls: 'icon_usuario',
                    menu: [
                        {
                            text: 'Adm. Usuarios',
                            itemId: 'usuario/Usuario',
                            iconCls: 'icon_usuario'
                        }
                    ]
                },
                {
                    xtype: 'menuseparator'
                    //hidden: me.privilegio('menu.entidades')
                },
                {
                    text: 'Entidades',
                    itemId: 'entidad',
                    //hidden: me.privilegio('menu.entidades'),
                    iconCls: 'icon_entidad',
                    menu: [
                        {
                            text: 'Adm Entidades',
                            itemId: 'entidad/Entidad',
                            iconCls: 'icon_entidad'
                        }
                    ]
                },
                {
                    xtype: 'menuseparator'
                    //hidden: me.privilegio('menu.reportes')
                },
                /*{
                    text: 'Reportes',
                    itemId: 'reportes',
                    //hidden: me.privilegio('menu.reportes'),
                    iconCls: 'icon_reporte',
                    menu: [
                        {
                            text: 'Reporte: Biblioteca',
                            itemId: 'reportes/reporteBiblioteca',
                            id: 'reporte_biblioteca',
                            iconCls: 'icon_reporte'
                        },
                        {
                            text: 'Reporte: Ficha Social Familiar',
                            itemId: 'reportes/reporteFichaSocialFamiliar',
                            iconCls: 'icon_reporte'
                        }
                    ]
                },
                {
                    xtype: 'menuseparator'
                },*/
                {
                    text: 'Salir',
                    itemId: 'logout',
                    iconCls: 'icon_login'
                },
                {
                    xtype: 'menuseparator'
                },
                {
                    xtype: 'menuseparator',
                    height : 30,
                    border: false,
                    disabled: true
                },
                {
                    xtype: 'label',
                    html: '<strong>Usuario:</strong> ' + sisscsj.app.globals.globalNombreUsuario,
                    border: false
                },
                {
                    xtype: 'menuseparator',
                    border: false
                },
                {
                    xtype: 'label',
                    html: '<strong>Privilegio:</strong> ' + sisscsj.app.globals.globalTipoUsuario,
                    border: false
                }
            ]
        });
        me.callParent(arguments);
    },


    privilegio: function( opcion ) {
        var storePrivilegios = Ext.data.StoreManager.lookup('privilegio.Privilegio');
        var res = storePrivilegios.findRecord('nombre_privilegio_usuario', opcion);
        return ( res !== null ) ? false : true;
    }
});