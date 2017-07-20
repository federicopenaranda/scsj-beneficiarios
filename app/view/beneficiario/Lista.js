Ext.define('sisscsj.view.beneficiario.Lista', {
    extend: 'Ext.grid.Panel',
    alias: 'widget.beneficiario.lista',
    title: 'Administrar Beneficiarios',
    iconCls: 'icon_user',
    store: 'Beneficiario',
    scroll: true,
    minHeight: 250,
    initComponent: function() {
        var me = this;
        var storePrivilegios = Ext.create('Ext.data.Store', {
            fields: ['nombre', 'valor'],
            data : [
                {"nombre":"beneficiario.edit", "valor": false},
                {"nombre":"beneficiario.delete", "valor": (sisscsj.app.globals.globalTipoUsuario === 'admin') ? false : true }
            ]
        });
        Ext.applyIf(me, {
            columns: {
                defaults: {
                    flex: 0.2
                },
                sortAscText: 'Ordenar Ascendentemente',
                sortDescText: 'Ordenar Descendentemente',
                columnsText: 'Columnas',
                items: [
                    {
                        text: 'Nombre',
                        xtype: 'templatecolumn', 
                        tpl: '{primer_nombre_beneficiario} {segundo_nombre_beneficiario} {apellido_paterno_beneficiario} {apellido_materno_beneficiario}',
                        width: 250,
                        flex: 0.4
                    },
                    {
                        text: 'Fecha Nac.',
                        dataIndex: 'fecha_nacimiento_beneficiario',
                        xtype: 'datecolumn', 
                        format: 'Y-m-d',
                        width: 100
                    },
                    {
                        text: 'Tipo',
                        dataIndex: 'nombre_beneficiario_tipo',
                        width: 100,
                        hidden: true
                    },
                    {
                        text: 'Código',
                        dataIndex: 'codigo_beneficiario',
                        width: 100
                    },
                    {
                        text: 'Sexo',
                        dataIndex: 'sexo_beneficiario',
                        renderer: function (valor) {
                            if ( valor === 'm' )
                                return 'Masculino';
                            
                            if ( valor === 'f' )
                                return 'Femenino';
                            
                            return '';
                        },
                        width: 100
                    },
                    {
                        text: 'Religión',
                        dataIndex: 'nombre_religion',
                        width: 100
                    },
                    {
                        text: 'Ent. Salud',
                        dataIndex: 'nombre_entidad_salud',
                        width: 100,
                        hidden: true
                    },
                    {
                        text: 'Núm. Hijo',
                        dataIndex: 'numero_hijo_beneficiario',
                        width: 100,
                        hidden: true
                    },
                    {
                        xtype: 'booleancolumn', 
                        dataIndex: 'trabaja_beneficiario',
                        trueText: 'Si Trabaja',
                        falseText: 'No Trabaja', 
                        text: 'Trabaja?',
                        hidden: true
                    },
                    {
                        xtype: 'booleancolumn', 
                        dataIndex: 'carnet_de_salud_beneficiario',
                        trueText: 'Si Tiene',
                        falseText: 'No Tiene', 
                        text: 'Carnet de Salud?',
                        hidden: true
                    },
                    {
                        xtype: 'booleancolumn', 
                        dataIndex: 'libreta_escolar_beneficiario',
                        trueText: 'Si Tiene',
                        falseText: 'No Tiene', 
                        text: 'Libreta Escolar?',
                        hidden: true
                    }
                ]
            },
            dockedItems: [
                {
                    xtype: 'toolbar',
                    dock: 'top',
                    ui: 'footer',
                    items: [
                        {
                            xtype: 'button',
                            itemId: 'add',
                            //hidden: LocalStorePrivilegios.findRecord('nombre','beneficiario.lista.add').getData().valor,
                            iconCls: 'icon_add',
                            text: 'Añadir'
                        },
                        {
                            xtype: 'button',
                            itemId: 'edit',
                            hidden: storePrivilegios.findRecord('nombre','beneficiario.edit').getData().valor,
                            //hidden: LocalStorePrivilegios.findRecord('nombre','beneficiario.lista.edit').getData().valor,
                            iconCls: 'icon_edit',
                            text: 'Editar'
                        },
                        {
                            xtype: 'button',
                            itemId: 'delete',
                            iconCls: 'icon_delete',
                            hidden: storePrivilegios.findRecord('nombre','beneficiario.delete').getData().valor,
                            //hidden: LocalStorePrivilegios.findRecord('nombre','beneficiario.lista.delete').getData().valor,
                            text: 'Eliminar'
                        }, '->',
                        {
                            xtype:'splitbutton',
                            itemId: 'evaluaciones',
                            disabled: true,
                            text: 'Evaluaciones',
                            iconCls: 'icon_gear',
                            menu: [
                                {text: 'Atención Médica', itemId: 'eval_atencion_medica'},
                                {text: 'Enfermería', itemId: 'eval_enfermeria'},
                                {text: 'Odontología', itemId: 'eval_odontologia'},
                                {text: 'Nutrición', itemId: 'eval_nutricion'},
                                {text: 'Nelson Ortiz', itemId: 'eval_nelson_ortiz'},
                                {text: 'Child Fund', itemId: 'eval_child_fund'},
                                {text: 'Pedagógica', itemId: 'eval_pedagogia'},
                                {text: 'Psicológica', itemId: 'eval_psicologia'},
                                {text: 'Computación', itemId: 'eval_computacion'}
                            ]
                        },
                        {
                            xtype:'splitbutton',
                            itemId: 'reportes',
                            text: 'Reportes',
                            iconCls: 'icon_gear',
                            menu: [
                                //{text: 'Ficha Social', itemId: 'ficha_social'},
                                {text: 'Ficha Social Familiar', itemId: 'ficha_social_familiar'}
                            ]
                        },
                        {
                            xtype: 'button',
                            itemId: 'eval_biblioteca',
                            iconCls: 'icon_search',
                            text: 'Biblioteca'
                        },
                        {
                            xtype:'splitbutton',
                            itemId: 'buscar',
                            iconCls: 'icon_search',
                            text: 'Buscar',
                            menu: [
                                {text: 'Borrar Filtro', itemId: 'clear'}
                            ]
                        }
                    ]
                },
                {
                    xtype: 'pagingtoolbar',
                    ui: 'footer',
                    defaultButtonUI: 'default',
                    dock: 'bottom',
                    displayInfo: true,
                    store: me.getStore()
                }
            ]
        });
        me.callParent(arguments);
    }
});