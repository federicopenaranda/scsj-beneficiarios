Ext.define('sisscsj.view.actividad_proyecto.actividad_tipo_participante.edit.Form', {
    extend: 'Ext.form.Panel',
    alias: 'widget.actividad_proyecto.actividad_tipo_participante.edit.form',
    requires: [
        'Ext.form.FieldContainer',
        'Ext.form.field.Text',
        'Ext.form.field.ComboBox',
        'sisscsj.ux.form.field.RemoteComboBox',
        'sisscsj.view.actividad_proyecto.actividad_tipo_participante.Lista'
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
                            xtype: 'actividad_proyecto.actividad_tipo_participante.edit.tab.asistencia',
                            title: 'Asistencia'
                        }
                    ]
                }
            ]
        });
        me.callParent(arguments);
    }
});