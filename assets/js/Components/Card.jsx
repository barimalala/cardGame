import React from 'react';
import { createUseStyles } from 'react-jss';

const useStyles = createUseStyles({
    card:{
        display:'flex',
        flexDirection:'column',
        flex: '0 1 100px',
        background: 'gray',
        borderRadius: 5,
        padding: 5,
        margin: 5,
        height: 120,
        alignItems: 'center',
        justifyContent: 'center',
        cursor:'pointer',
    }
});

const Card = ({color = '',value = ''}) => {
    const classes = useStyles();

    return <div className={classes.card}>
                <div>{color}</div>
                <div>{value}</div>
            </div>;
}

export default Card;