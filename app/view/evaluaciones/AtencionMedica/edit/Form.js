Ext.define('sisscsj.view.evaluaciones.AtencionMedica.edit.Form', {
    extend: 'Ext.form.Panel',
    alias: 'widget.evaluaciones.atencionmedica.edit.form',
    requires: [
        'Ext.form.FieldContainer',
        'Ext.form.field.Text',
        'Ext.form.field.ComboBox',
        'sisscsj.ux.form.field.RemoteComboBox',
        'sisscsj.view.evaluaciones.AtencionMedica.Lista',
        'sisscsj.view.evaluaciones.AtencionMedica.edit.tab.EnfermedadComun',
        'sisscsj.view.evaluaciones.AtencionMedica.edit.tab.Evaluacion'
    ],
    initComponent: function() {
        var me = this;
        Ext.applyIf(me, {
            fieldDefaults: {
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
                            xtype: 'evaluaciones.atencionmedica.edit.tab.evaluacion',
                            title: 'Evaluación'
                        },
                        {
                            xtype: 'evaluaciones.atencionmedica.edit.tab.enfermedadcomun',
                            title: 'Enfermedades'
                        }
                    ]
                }
            ]
        });
        me.callParent(arguments);
    }
});