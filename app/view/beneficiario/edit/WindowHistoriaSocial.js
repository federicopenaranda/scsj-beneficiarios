Ext.define('sisscsj.view.beneficiario.edit.WindowHistoriaSocial', {
    extend: 'Ext.window.Window',
    alias: 'widget.beneficiario.edit.windowhistoriasocial',
    requires: [
        'sisscsj.view.beneficiario.edit.FormHistoriaSocial'
    ],
    iconCls: 'icon_user',
    width: 650,
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
                    xtype: 'beneficiario.edit.formhistoriasocial'
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