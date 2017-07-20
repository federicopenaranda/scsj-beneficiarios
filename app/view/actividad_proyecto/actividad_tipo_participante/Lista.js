Ext.define('sisscsj.view.actividad_proyecto.actividad_tipo_participante.Lista', {
    extend: 'Ext.grid.Panel',
    alias: 'widget.actividad_proyecto.actividad_tipo_participante.lista',
    header: false,
    iconCls: 'icon_user',
    store: {
        type: 'actividad_proyecto.actividadtipoparticipante'
    },
    minHeight: 250,
    initComponent: function() {
        var me = this;
        Ext.applyIf(me, {
            columns: {
                defaults: {
                    flex: 1
                },
                sortAscText: 'Ordenar Ascendentemente',
                sortDescText: 'Ordenar Descendentemente',
                columnsText: 'Columnas',
                items: [
                    {
                        text: 'Tipo de Participante',
                        dataIndex: 'fk_id_edades_beneficiario',
                        renderer: function( value, metaData, record, rowIndex, colIndex, store, view ) {
                            return record.get( 'nombre_edades_beneficiario' );
                        }
                    },
                    {
                        text: 'Cantidad',
                        dataIndex: 'cantidad_actividad_tipo_participante'
                    },
                    {
                        text: 'Género',
                        dataIndex: 'sexo_actividad_tipo_participante',
                        renderer: function( value, metaData, record, rowIndex, colIndex, store, view ) {
                            return ( value === 'f' ) ? 'Mujer' : 'Varón';
                        }
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