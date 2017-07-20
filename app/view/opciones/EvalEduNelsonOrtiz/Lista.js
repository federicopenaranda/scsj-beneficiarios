/**
 * Grid for displaying Staff details
 */
Ext.define('sisscsj.view.opciones.EvalEduNelsonOrtiz.Lista', {
    extend: 'Ext.grid.Panel',
    alias: 'widget.opciones.evaledunelsonortiz.lista',
    title: 'Administrar Evaluaciones Nelson Ortiz',
    iconCls: 'icon_user',
    store: 'EvalEduNelsonOrtiz',
    minHeight: 250,
    initComponent: function() {
        var me = this;
        Ext.applyIf(me, {
            columns: {
                defaults: {},
                items: [
                    {
                        text: 'Nombre',
                        dataIndex: 'primer_nombre_beneficiario',
                        width: 200
                    },
                    {
                        text: 'Apellido',
                        dataIndex: 'apellido_paterno_beneficiario',
                        width: 150
                    },
                    {
                        text: 'Tipo de Consulta',
                        dataIndex: 'nombre_tipo_consulta',
                        width: 450
                    },
                    {
                        text: 'Fecha',
                        dataIndex: 'fecha_nelson_ortiz',
                        width: 250
                    },
                    {
                        text: 'Motricidad Gruesa',
                        dataIndex: 'motricidad_gruesa_nelson_ortiz',
                        width: 250
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
                            iconCls: 'icon_add',
                            text: 'Añadir'
                        },
                        {
                            xtype: 'button',
                            itemId: 'edit',
                            iconCls: 'icon_edit',
                            text: 'Editar'
                        },
                        {
                            xtype: 'button',
                            itemId: 'delete',
                            iconCls: 'icon_delete',
                            text: 'Eliminar'
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