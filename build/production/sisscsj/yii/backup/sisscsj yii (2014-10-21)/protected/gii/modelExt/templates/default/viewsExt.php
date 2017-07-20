<?php $mode=new $this->nomodel;?>
Ext.define('sisscsj.view.opciones.<?php echo $this->nomodel;?>.Lista', {
    extend: 'Ext.grid.Panel',
    alias: 'widget.opciones.<?php echo strtolower($this->nomodel);?>.lista',
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
<?php $num=count($mode->attributeLabels());$sw=0;foreach($mode->attributeNames() as $name){if($sw!==0){if($num!==1){?>
                	{
                	   text:'Nombre',
                	   dataIndex:'<?php echo $name?>',
                	   editor:{
                		  xtype:'textfield',
                		  allowBlack:false
                	   },
                	   flex: .5
                	},
<?php }else{?>
                    {
                       text:'Nombre',
                       dataIndex:'<?php echo $name?>',
                       editor:{
                          xtype:'textfield',
                          allowBlack:false
                       },
                       flex: .5
                    }
<?php }}else{$sw=1;}$num--;}?>
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
                            itemId: 'delete',
                            iconCls: 'icon_delete',
                            text: 'Eliminar'
                        },
                        {
                            xtype: 'button',
                            itemId: 'edit',
                            iconCls: 'icon_edit',
                            text: 'Editar'
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

