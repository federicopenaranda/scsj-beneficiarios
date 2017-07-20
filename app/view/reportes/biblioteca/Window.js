Ext.define('sisscsj.view.reportes.biblioteca.Window', {
    extend: 'Ext.window.Window',
    alias: 'widget.reportes.biblioteca.window',
    requires: [
        'sisscsj.view.reportes.biblioteca.Form'
    ],
    iconCls: 'icon_user',
    constrain: true,
    width: 800,
    height: 500,
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
                    xtype: 'reportes.biblioteca.form'
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
                            itemId: 'generar',
                            text: 'Generar',
                            iconCls: 'icon_save'
                        }
                    ]
                }
            ]
        });
        me.callParent(arguments);
    }
});