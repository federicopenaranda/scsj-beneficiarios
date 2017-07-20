Ext.define('sisscsj.view.security.login.Window', {
    extend: 'Ext.window.Window',
    alias: 'widget.security.login.window',
    title: 'Ingresar a Sistema SISSCSJ',
    modal: true,
    layout: 'fit',
    resizable: false,
    closable: false,
    draggable: false,
    width: 300,
    bodyPadding: 10,
    initComponent: function() {
        var me = this;
        Ext.applyIf(me, {
            items: [
                {
                    xtype: 'security.login.form'
                }
            ],
            dockedItems: [
                {
                    xtype: 'toolbar',
                    dock: 'bottom',
                    ui: 'footer',
                    items: [
                        '->',
                        {
                            xtype: 'button',
                            text: 'Ingresar',
                            itemId: 'login',
                            iconCls: 'icon_login'
                        }
                    ]
                }
            ]
        });
        me.callParent( arguments );
    }
});