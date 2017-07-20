Ext.define('sisscsj.view.usuario.Lista', {
    extend: 'Ext.grid.Panel',
    alias: 'widget.usuario.lista',
    title: 'Administrar Usuarios',
    iconCls: 'icon_user',
    store: 'Usuario',
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
                        text: 'Nombre',
                        dataIndex: 'nombre_usuario'
                    },
                    {
                        text: 'Login',
                        dataIndex: 'login_usuario'
                    },
                    {
                        text: 'Tipo',
                        dataIndex: 'fk_id_tipo_usuario',
                        renderer: function( value, metaData, record, rowIndex, colIndex, store, view ) {
                            return record.get( 'nombre_tipo_usuario' )
                        }
                    },
                    {
                        text: 'Sexo',
                        dataIndex: 'sexo_usuario',
                        renderer: function (valor) {
                            if ( valor === 'm' )
                                return 'Masculino';
                            
                            if ( valor === 'f' )
                                return 'Femenino';
                            
                            return '';
                        }
                    },
                    {
                        text: 'Teléfono',
                        dataIndex: 'telefono_usuario'
                    },
                    {
                        text: 'Celular',
                        dataIndex: 'celular_usuario'
                    },
                    {
                        text: 'Correo',
                        dataIndex: 'correo_usuario'
                    },
                    {
                        text: 'Dirección',
                        dataIndex: 'direccion_usuario',
                        hidden: true
                    },
                    {
                        text: 'Observaciones',
                        dataIndex: 'observacion_usuario',
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