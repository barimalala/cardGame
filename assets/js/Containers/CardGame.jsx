import React,{ useState,useEffect }  from 'react';
import { createUseStyles } from 'react-jss';
import axios from 'axios';
import * as constants from '../constants';

import Card from '../Components/Card'

const useStyles = createUseStyles({
    CardGame:{
        composes: 'col-lg-12',
    },
    CardContainer:{
        display:'flex',
    },
    btn:{
        composes:'btn btn-lg btn-primary'
    }
});

const CardGame = () => {
    const classes = useStyles();
    const [colors, setColors] = useState([]);
    const [values, setValues] = useState([]);
    const [cards, setCards] = useState([]);
    const [ordonedCards, setOrdonedCards] = useState([]);

    const onHandleColor = async () => {
        try{
            const randomColors = await axios.get(constants.API_ENDPOINT_COLOR);
            setColors(randomColors.data.colors);
        }catch(e){
            setColors([]);
        }
    }

    const onHandleValues = async () => {
        try{
            const randomValues = await axios.get(constants.API_ENDPOINT_VALUE);
            setValues(randomValues.data.grades);
        }catch(e){
            setValues([]);
        }
    }

    const onHandleCards = async () => {
        try{
            const randomCards = await axios.get(constants.API_ENDPOINT+'/10');
            setCards(randomCards.data.cards);
        }catch(e){
            setCards([]);
        }
    }

    const onHandleSortCards = async () => {
        try{
            const randomCards = await axios.get(constants.API_ENDPOINT_ORDER,{
                params:{
                    cards,
                    grade:values,
                    color:colors,
                }
            });
            setOrdonedCards(randomCards.data.cards);
        }catch(e){
            setOrdonedCards([]);
        }
    }

    return <div className={classes.CardGame}>
            <div className='row'>
                <label>Construire l'ordre aleatoire des couleurs </label>
                <div className="col-lg-12">
                    <button className={classes.btn} onClick={()=>onHandleColor()}>{colors.lengh>0 ?"Modifier":"Charger"}</button>
                    <div className={classes.CardContainer}>
                        {colors.map((color,index)=>
                            <Card color={color} key={index}/>
                        )}
                    </div>
                </div>
            </div>
            <div className='row'>
                <label>Construire l'ordre aleatoire des valeurs </label>
                <div className="col-lg-12">
                    <button className={classes.btn}  onClick={()=>onHandleValues()} >{values.lengh>0 ?"Modifier":"Charger"}</button>
                    <div className={classes.CardContainer} >
                        {values.map((value,index)=>
                            <Card value={value} key={index} />
                        )}
                    </div>
                </div>
            </div>
            <div className='row'>
                <label>Vos cartes: </label>
                <div className="col-lg-12">
                    <button className={classes.btn} onClick={()=>onHandleCards()} >{cards.lengh>0 ?"Modifier":"Charger"}</button>
                    <div className={classes.CardContainer}  >
                        {cards.map((card,index)=>
                            <Card value={card.grade} color={card.color} key={index}/>
                        )}
                    </div>
                    {(colors.length>0 && values.length>0 && cards.length>0) &&<>
                        <button className={classes.btn}  onClick={()=>onHandleSortCards()} >Ranger vos cartes</button>
                    <div className={classes.CardContainer}  >
                        {ordonedCards.map((card,index)=>
                            <Card value={card.grade} color={card.color} key={index}/>
                        )}
                    </div>
                    </>
                    }
                </div>
            </div>
            </div>;
}

export default CardGame;