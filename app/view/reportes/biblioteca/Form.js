Ext.define('sisscsj.view.reportes.biblioteca.Form', {
    extend: 'Ext.form.Panel',
    alias: 'widget.reportes.biblioteca.form',
    /*requires: [
        'Ext.form.FieldContainer',
        'Ext.form.field.Text'
    ],*/
    initComponent: function() {
        var me = this;
        Ext.applyIf(me, {
            fieldDefaults: {
                allowBlank: false,
                labelAlign: 'top',
                flex: 1,
                margins: 5
            },
            items: [
                {
                    xtype: 'tabpanel',
                    bodyPadding: 5,
                    // set to false to disable lazy render of non-active tabs...IMPORTANT!!!
                    deferredRender: false,
                    items: [
                        {
                            xtype: 'reportes.biblioteca.tab.parametros',
                            title: 'Parámetros de Reporte'
                        }
                    ]
                }
            ]
        });
        me.callParent(arguments);
    }
});