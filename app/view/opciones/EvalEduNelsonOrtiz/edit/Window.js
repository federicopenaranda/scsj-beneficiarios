Ext.define('sisscsj.view.opciones.EvalEduNelsonOrtiz.edit.Window', {
    extend: 'Ext.window.Window',
    alias: 'widget.opciones.evaledunelsonortiz.edit.window',
    requires: [
        'sisscsj.view.opciones.EvalEduNelsonOrtiz.edit.Form'
    ],
    iconCls: 'icon_user',
    width: 600,
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
                    xtype: 'opciones.evaledunelsonortiz.edit.form'
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