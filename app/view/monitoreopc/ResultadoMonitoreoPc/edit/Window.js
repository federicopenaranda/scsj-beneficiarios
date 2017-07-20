Ext.define('sisscsj.view.monitoreopc.ResultadoMonitoreoPc.edit.Window', {
    extend: 'Ext.window.Window',
    alias: 'widget.monitoreopc.resultadomonitoreopc.edit.window',
    requires: [
        'sisscsj.view.monitoreopc.ResultadoMonitoreoPc.edit.Form'
    ],
    iconCls: 'icon_user',
    width: 400,
    height: 300,
    modal: true,
    resizable: true,
    draggable: true,
    constrainHeader: true,
    layout: 'fit',
    initComponent: function() {
        var me = this;
        Ext.applyIf(me, {
            items: [
                {
                    // include form
                    xtype: 'monitoreopc.resultadomonitoreopc.edit.form'
                }
            ],
            dockedItems: [
                {
                    xtype: 'toolbar',
                    dock: 'bottom',
                    ui: 'footer',
                    items: [
                        {
                            xtype: 'button',
                            itemId: 'cancel',
                            text: 'Cancelar',
                            iconCls: 'icon_delete'
                        },
                        '->',
                        {
                            xtype: 'button',
                            itemId: 'save',
                            text: 'Guardar',
                            iconCls: 'icon_save'
                        }
                    ]
                }
            ]
        });
        me.callParent(arguments);
    }
});