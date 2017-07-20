Ext.define('sisscsj.view.evaluaciones.Nutricion.edit.WindowEvaluacion', {
    extend: 'Ext.window.Window',
    alias: 'widget.evaluaciones.nutricion.edit.windowevaluacion',
    requires: [
        'sisscsj.view.evaluaciones.Nutricion.edit.Form'
    ],
    iconCls: 'icon_user',
    width: 700,
    height: 460,
    margins: -5,
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
                    xtype: 'evaluaciones.nutricion.edit.form'
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