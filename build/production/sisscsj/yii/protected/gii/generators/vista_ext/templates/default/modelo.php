<?php
/**
 * This is the template for generating the model class of a specified table.
 * - $this: the ModelCode object
 * - $tableName: the table name for this class (prefix is already removed if necessary)
 * - $modelClass: the model class name
 * - $columns: list of table columns (name=>CDbColumnSchema)
 * - $labels: list of attribute labels (name=>label)
 * - $rules: list of validation rules
 * - $relations: list of relations (name=>relation declaration)
 * - <?php echo $tableName; ?>
 * - <?php echo $modelClass; ?>
 *<?php foreach($labels as $name=>$label): ?>
			<?php echo "'$name' => '$label',\n"; ?>
<?php endforeach; ?>
 
 */
?>
<?php #echo print_r($columns);?>
<?php 
$contPrimaryKey=0;
foreach($columns as $column):
if($column->isPrimaryKey==1)
	$contPrimaryKey++; 
endforeach; 
?>
<?php $path=str_replace("C:/xampp/htdocs/","",Yii::getPathOfAlias('webroot'));?>
<?php if(sizeof($labels)<=3):?>
Ext.define('<?php echo $path;?>.view.<?php echo strtolower($modelClass); ?>.Lista', {
    extend: 'Ext.grid.Panel',
    alias: 'widget.<?php echo strtolower($modelClass); ?>.lista',
    requires: [
        'Ext.grid.plugin.RowEditing',
        'Ext.toolbar.Paging'
    ],
    minHeight: 250,
    initComponent: function() {
        var me = this;
        Ext.applyIf(me, {
            selType: 'rowmodel',
            plugins: [
                {
                    ptype: 'rowediting',
                    clicksToEdit: 2,
                    saveBtnText: 'Guardar',
                    cancelBtnText: 'Cancelar',
                    errorsText: 'Errores',
                    dirtyText: 'Es necesario guardar o cancelar los cambios.'
                }
            ],
            columns: {
                defaults: {
                	flex: .2
                },
                items: [
<?php $cont=0;foreach($columns as $column):$cont++; ?>
<?php if($cont!==sizeof($columns)) {?>
					 {
                        text: '<?php echo $labels[$column->name];?>',
                        dataIndex: '<?php echo $labels[$column->name];?>',
<?php if($column->type=="string" && $column->dbType!=="datetime" && $column->dbType!=="date"): ?>
                        editor: {
                            xtype: 'textfield',
                            allowBlack: false
                        }
                    },
<?php endif;?>
<?php if($column->type=="integer" && $column->size>1): ?>
						maxValue: [VALOR MÁXIMO],
	                      minValue: [VALOR MÍNIMO],
                        editor: {
                            xtype: 'numberfield',
                            allowBlack: false
                        }
                    },
<?php endif;?>
<?php if($column->type=="integer" && $column->size==1): ?>
						renderer: function (valor) {
                            return (valor === 1 ) ? 'Activo' : 'Inactivo';
                        },
                        editor: {
                            xtype: 'combo',
                            allowBlack: false,
                            store: LocalStoreEstado,
                            triggerAction: 'all',
                            valueField: 'valor',
                            displayField: 'nombre',
                            queryMode: 'local',
                            forceSelection: true,
                            editable: false
                        }
                    },
<?php endif;?>
<?php if($column->dbType=="date" || $column->dbType=="datetime"): ?>
						renderer: Ext.util.Format.dateRenderer('Y-m-d'),
                        editor: {
                            xtype: 'datefield',
                            format: 'Y-m-d'
                        }
                    },
<?php endif;?>
<?php } else {?>
					{
                        text: '<?php echo $labels[$column->name];?>',
                        dataIndex: '<?php echo $labels[$column->name];?>',
<?php if($column->type=="string" && $column->dbType!=="datetime" && $column->dbType!=="date"): ?>
                        editor: {
                            xtype: 'textfield',
                            allowBlack: false
                        }
                    }
<?php endif;?>
<?php if($column->type=="integer" && $column->size>1): ?>
						maxValue: [VALOR MÁXIMO],
	                      minValue: [VALOR MÍNIMO],
                        editor: {
                            xtype: 'numberfield',
                            allowBlack: false
                        }
                    }
<?php endif;?>
<?php if($column->type=="integer" && $column->size==1): ?>
						renderer: function (valor) {
                            return (valor === 1 ) ? 'Activo' : 'Inactivo';
                        },
                        editor: {
                            xtype: 'combo',
                            allowBlack: false,
                            store: LocalStoreEstado,
                            triggerAction: 'all',
                            valueField: 'valor',
                            displayField: 'nombre',
                            queryMode: 'local',
                            forceSelection: true,
                            editable: false
                        }
                    }
<?php endif;?>
<?php if($column->dbType=="date" || $column->dbType=="datetime"): ?>
						renderer: Ext.util.Format.dateRenderer('Y-m-d'),
                        editor: {
                            xtype: 'datefield',
                            format: 'Y-m-d'
                        }
                    }
<?php endif;?>
<?php } ?>
<?php endforeach;?>
				 ]
            },
            dockedItems: [
                {
                    xtype: 'toolbar',
                    dock: 'top',
                    ui: 'footer',
                    items: [
                        {
                            xtype: 'button',
                            itemId: 'add',
                            iconCls: 'icon_add',
                            text: 'Añadir'
                        },
                        {
                            xtype: 'button',
                            itemId: 'edit',
                            iconCls: 'icon_edit',
                            text: 'Editar'
                        },
                        {
                            xtype: 'button',
                            itemId: 'delete',
                            iconCls: 'icon_delete',
                            text: 'Eliminar'
                        }
                    ]
                },
                {
                    xtype: 'pagingtoolbar',
                    ui: 'footer',
                    defaultButtonUI: 'default',
                    dock: 'bottom',
                    displayInfo: true,
                    store: me.getStore(),
                    beforePageText: 'Página',
                    afterPageText: 'de {0}',
                    displayMsg: 'Mostrando {0} - {1} de {2}',
                    prevText: 'Anterior Página',
                    emptyMsg: 'No existen datos',
                    refreshText: 'Recargar',
                    nextText: 'Siguiente Página',
                    firstText: 'Primera Página',
                    lastText: 'Última Página'
                }
            ]
        });
        me.callParent(arguments);
    }
});
<?php endif;?>
                
                

