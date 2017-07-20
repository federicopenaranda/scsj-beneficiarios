Ext.define('sisscsj.view.evaluaciones.Biblioteca.edit.WindowRep1', {
    extend: 'Ext.window.Window',
    alias: 'widget.evaluaciones.biblioteca.edit.windowrep1',
    requires: [
        'sisscsj.view.evaluaciones.Biblioteca.edit.FormRep1'
    ],
    iconCls: 'icon_user',
    width: 350,
    height: 180,
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
                    xtype: 'evaluaciones.biblioteca.edit.formrep1'
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