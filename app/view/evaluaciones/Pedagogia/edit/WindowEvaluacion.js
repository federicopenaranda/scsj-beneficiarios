Ext.define('sisscsj.view.evaluaciones.Pedagogia.edit.WindowEvaluacion', {
    extend: 'Ext.window.Window',
    alias: 'widget.evaluaciones.pedagogia.edit.windowevaluacion',
    requires: [
        'sisscsj.view.evaluaciones.Pedagogia.edit.Form'
    ],
    iconCls: 'icon_user',
    width: 600,
    height: 550,
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
                    xtype: 'evaluaciones.pedagogia.edit.form'
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