Ext.define('sisscsj.view.opciones.PrivilegiosUsuario.Lista', {
    extend: 'Ext.grid.Panel',
    alias: 'widget.opciones.privilegiosusuario.lista',
    requires: [
        'Ext.grid.plugin.RowEditing',
        'Ext.toolbar.Paging'
    ],
    minHeight: 250,
    initComponent: function() {
        var me = this;
        Ext.applyIf(me, {
            selType: 'rowmodel',
            plugins: [
                {
                    ptype: 'rowediting',
                    clicksToEdit: 2
                }
            ],
            columns: {
                defaults: {},
                items: [
                	{
                	   text:'Nombre',
                	   dataIndex:'nombre_privilegio_usuario',
                	   editor:{
                		  xtype:'textfield',
                		  allowBlack:false
                	   },
                	   flex: .5
                	},
                	{
                	   text:'Nombre',
                	   dataIndex:'accion_privilegio_usuario',
                	   editor:{
                		  xtype:'textfield',
                		  allowBlack:false
                	   },
                	   flex: .5
                	},
                	{
                	   text:'Nombre',
                	   dataIndex:'opciones_privilegio_usuario',
                	   editor:{
                		  xtype:'textfield',
                		  allowBlack:false
                	   },
                	   flex: .5
                	},
                	{
                	   text:'Nombre',
                	   dataIndex:'funcion_privilegio_usuario',
                	   editor:{
                		  xtype:'textfield',
                		  allowBlack:false
                	   },
                	   flex: .5
                	},
                    {
                       text:'Nombre',
                       dataIndex:'descripcion_privilegios_usuario',
                       editor:{
                          xtype:'textfield',
                          allowBlack:false
                       },
                       flex: .5
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

