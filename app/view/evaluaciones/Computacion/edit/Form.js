Ext.define('sisscsj.view.evaluaciones.Computacion.edit.Form', {
    extend: 'Ext.form.Panel',
    alias: 'widget.evaluaciones.computacion.edit.form',
    requires: [
        'Ext.form.FieldContainer',
        'Ext.form.field.Text',
        'Ext.form.field.ComboBox',
        'sisscsj.ux.form.field.RemoteComboBox',
        'sisscsj.view.evaluaciones.Computacion.Lista',
        'sisscsj.view.evaluaciones.Computacion.edit.tab.Evaluacion'
    ],
    initComponent: function() {
        var me = this;
        Ext.applyIf(me, {
            fieldDefaults: {
                allowBlank: false,
                labelAlign: 'top',
                flex: 1,
                margins: 5
            },
            defaults: {
                layout: 'hbox',
                margins: '0 10 0 10'
            },
            items: [
                {
                    xtype: 'tabpanel',
                    bodyPadding: 5,
                    // set to false to disable lazy render of non-active tabs...IMPORTANT!!!
                    deferredRender: false,
                    items: [
                        {
                            xtype: 'evaluaciones.computacion.edit.tab.evaluacion',
                            title: 'Evaluación'
                        }
                    ]
                }
            ]
        });
        me.callParent(arguments);
    }
});