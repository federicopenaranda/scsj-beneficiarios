Ext.define('sisscsj.view.evaluaciones.Psicologia.edit.WindowEvaluacion', {
    extend: 'Ext.window.Window',
    alias: 'widget.evaluaciones.psicologia.edit.windowevaluacion',
    requires: [
        'sisscsj.view.evaluaciones.Psicologia.edit.Form'
    ],
    iconCls: 'icon_user',
    width: 650,
    height: 500,
    modal: true,
    resizable: true,
    draggable: true,
    layout: 'fit',
    initComponent: function() {
        var me = this;
        Ext.applyIf(me, {
            items: [
                {
                    // include form
                    xtype: 'evaluaciones.psicologia.edit.form'
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