Ext.define('sisscsj.view.participante.edit.FormEstadoParticipante', {
    extend: 'Ext.form.Panel',
    alias: 'widget.participante.edit.formestadoparticipante',
    requires: [
        'Ext.form.FieldContainer',
        'Ext.form.field.Text',
        'Ext.form.field.ComboBox',
        'sisscsj.ux.form.field.RemoteComboBox'
    ],
    bodyPadding: 5,
    initComponent: function() {
        var me = this;
        Ext.applyIf(me, {
            fieldDefaults: {
                allowBlank: true,
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
                    xtype: 'fieldcontainer',
                    items: [
                        {
                            xtype: 'ux.form.field.remotecombobox',
                            name: 'fk_id_estado_beneficiario',
                            fieldLabel: 'Estado:',
                            displayField: 'nombre_estado_beneficiario',
                            valueField: 'id_estado_beneficiario',
                            store: {
                                type: 'opciones.estadobeneficiario'
                            },
                            plugins: [
                                { ptype: 'cleartrigger' }
                            ],
                            editable: false,
                            forceSelection: true,
                            allowBlank: false
                        },
                        {
                            xtype: 'ux.form.field.remotecombobox',
                            name: 'fk_id_beneficiario_tipo',
                            fieldLabel: 'Tipo:',
                            displayField: 'nombre_beneficiario_tipo',
                            valueField: 'id_beneficiario_tipo',
                            store: {
                                type: 'opciones.beneficiariotipo'
                            },
                            plugins: [
                                { ptype: 'cleartrigger' }
                            ],
                            editable: false,
                            forceSelection: true,
                            allowBlank: false
                        }
                    ]
                },
                {
                    xtype: 'fieldcontainer',
                    items: [
                        {
                            xtype: 'ux.form.field.remotecombobox',
                            name: 'fk_id_edades_beneficiario',
                            fieldLabel: 'Edad:',
                            displayField: 'nombre_edades_beneficiario',
                            displayTpl: Ext.create('Ext.XTemplate',
                                        '<tpl for=".">',
                                            '{nombre_edades_beneficiario} ({descripcion_edades_beneficiario})',
                                        '</tpl>'),
                                    tpl: Ext.create('Ext.XTemplate',
                                        '<tpl for=".">',
                                            '<div class="x-boundlist-item">{nombre_edades_beneficiario} ({descripcion_edades_beneficiario})</div>',
                                        '</tpl>'),
                            valueField: 'id_edades_beneficiario',
                            store: {
                                type: 'opciones.edadesbeneficiario'
                            },
                            plugins: [
                                { ptype: 'cleartrigger' }
                            ],
                            editable: false,
                            forceSelection: true,
                            allowBlank: false
                        },
                        {
                            xtype: 'ux.form.field.remotecombobox',
                            name: 'fk_id_tipo_actor_beneficiario',
                            fieldLabel: 'Tipo de Actor:',
                            displayField: 'nombre_tipo_actor_beneficiario',
                            valueField: 'id_tipo_actor_beneficiario',
                            store: {
                                type: 'opciones.tipoactor'
                            },
                            plugins: [
                                { ptype: 'cleartrigger' }
                            ],
                            editable: false,
                            forceSelection: true,
                            allowBlank: false
                        }
                    ]
                },
                {
                    xtype: 'fieldcontainer',
                    items: [
                        {
                            xtype: 'datefield',
                            name: 'fecha_asignacion_estado_beneficiario',
                            fieldLabel: 'Fecha Asignación',
                            format: 'Y-m-d',
                            submitFormat: 'Y-m-d',
                            allowBlank: false
                        },
                        {
                            xtype: 'combo',
                            name: 'modalidad_estado_beneficiario',
                            fieldLabel: 'Educación:',
                            displayField: 'nombre',
                            valueField: 'valor',
                            store: LocalStoreModalidad,
                            plugins: [
                                { ptype: 'cleartrigger' }
                            ],
                            editable: false,
                            forceSelection: true,
                            allowBlank: true
                        }
                    ]
                },
                {
                    xtype: 'fieldcontainer',
                    items: [
                        {
                            xtype: 'textareafield',
                            name: 'observaciones_beneficiario_estado_beneficiario',
                            fieldLabel: 'Observaciones'
                        }
                    ]
                }
            ]
        });
        me.callParent(arguments);
    }
});