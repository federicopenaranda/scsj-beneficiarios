Ext.define('sisscsj.view.evaluaciones.Biblioteca.Lista', {
    extend: 'Ext.grid.Panel',
    alias: 'widget.evaluaciones.biblioteca.lista',
    header: false,
    iconCls: 'icon_user',
    store: {
        type: 'evaluaciones.biblioteca'
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
                        text: 'Área',
                        dataIndex: 'fk_id_area_cononcimiento_biblioteca',
                        renderer: function( value, metaData, record, rowIndex, colIndex, store, view ) {
                            return record.get( 'nombre_area_conocimiento_biblioteca' );
                        }
                    },
                    {
                        text: 'Nivel',
                        dataIndex: 'fk_id_nivel',
                        renderer: function( value, metaData, record, rowIndex, colIndex, store, view ) {
                            return record.get( 'nombre_nivel' );
                        }
                    },
                    {
                        text: 'Curso',
                        dataIndex: 'fk_id_curso',
                        renderer: function( value, metaData, record, rowIndex, colIndex, store, view ) {
                            return record.get( 'nombre_curso' );
                        }
                    },
                    {
                        text: 'Turno',
                        dataIndex: 'fk_id_turno',
                        renderer: function( value, metaData, record, rowIndex, colIndex, store, view ) {
                            return record.get( 'nombre_turno' );
                        }
                    },
                    {
                        text: 'Tipo de Usuario',
                        dataIndex: 'tipo_usuario_biblioteca'
                    },
                    {
                        text: 'Sexo',
                        dataIndex: 'sexo_usuario_biblioteca',
                        renderer: function (valor) {
                            if ( valor === 'f' )
                                return 'Femenino';
                            
                            if ( valor === 'm' )
                                return 'Masculino';
                            
                            return '';
                        }
                    },
                    {
                        text: 'Fecha',
                        xtype: 'datecolumn', 
                        dataIndex: 'fecha_consulta_biblioteca',
                        format: 'Y-m-d'
                        //renderer: Ext.util.Format.dateRenderer('Y-m-d')
                    },
                    {
                        text: 'Observaciones',
                        dataIndex: 'observaciones_biblioteca',
                        width: 100
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
                            xtype:'splitbutton',
                            itemId: 'reportesBiblioteca',
                            iconCls: 'icon_search',
                            text: 'Reportes',
                            menu: [
                                {text: 'Reporte General', itemId: 'reporteGeneral'}
                            ]
                        },
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