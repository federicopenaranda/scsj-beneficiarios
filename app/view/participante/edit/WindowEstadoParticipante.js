Ext.define('sisscsj.view.participante.edit.WindowEstadoParticipante', {
    extend: 'Ext.window.Window',
    alias: 'widget.participante.edit.windowestadoparticipante',
    requires: [
        'sisscsj.view.participante.edit.FormEstadoParticipante'
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
                    xtype: 'participante.edit.formestadoparticipante'
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