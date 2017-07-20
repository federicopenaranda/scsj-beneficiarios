Ext.define('sisscsj.view.security.login.Form', {
    extend: 'Ext.form.Panel',
    alias: 'widget.security.login.form',
    initComponent: function() {
        var me = this;
        Ext.applyIf(me, {
            defaults: {
                anchor: '100%'
            },
            items: [
                {
                    xtype: 'textfield',
                    name: 'Username',
                    fieldLabel: 'Usuario'
                },
                {
                    xtype: 'textfield',
                    name: 'Password',
                    inputType: 'password',
                    fieldLabel: 'Contraseña'
                }
            ]
        });
        me.callParent( arguments );
    }
});